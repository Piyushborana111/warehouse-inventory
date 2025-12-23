<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search  = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $users = User::with(['organization', 'roles'])
        ->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $users, // pagination object
            'message' => 'Users fetched successfully'
        ], 200);
    }

    /**
     * Store a newly created user in database.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        // Validate incoming request data
        $validatedData = $request->validated();

        
        // Create user
        $user = User::create([
            'name'            => $validatedData['name'],
            'email'           => $validatedData['email'],
            'password'        => Hash::make($validatedData['password']),
            'organization_id' => $validatedData['organization_id'] ?? null,
        ]);

        // ✅ Assign role to user
        $user->assignRole($validatedData['role']);

        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User created successfully'
        ], 201);
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        // Fetch user with organization
        $user = User::with('organization')->findOrFail($id);
        // Load role relationship for response
        $user->load('roles');
        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User fetched successfully'
        ], 200);
    }

    /**
     * Update the specified user in database.
     *
     * @param  \App\Http\Requests\UpdateUserRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, string $id)
    {
     
        // Find user record
        $user = User::findOrFail($id);

        // Validate update data
        $validatedData = $request->validated();

        // Update user fields
        $user->name  = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->syncRoles([$validatedData['role']]);
        

        $user->save();

        // Load role relationship for response
        $user->load('roles');

        return response()->json([
            'success' => true,
            'data'    => $user,
            'message' => 'User updated successfully'
        ], 200);
    }

    /**
     * Remove the specified user from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        // Find user or fail
        $user = User::findOrFail($id);

        // Delete user (hard delete by default)
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }
}
