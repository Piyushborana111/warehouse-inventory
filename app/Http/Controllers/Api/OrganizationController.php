<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch all organizations ordered by latest created
        $organizations = Organization::latest()->get();

        // Return JSON response
        return response()->json([
            'success' => true,
            'data'    => $organizations,
            'message' => 'Organizations fetched successfully'
        ], 200);
    }

    /**
     * Store a newly created organization in database.
     *
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrganizationRequest $request)
    {
        // Create organization using mass assignment
        $organization = Organization::create($request->validated());

        // Return success response
        return response()->json([
            'success' => true,
            'data'    => $organization,
            'message' => 'Organization created successfully'
        ], 201);
    }

    /**
     * Display the specified organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Find organization by ID or throw 404 exception
        $organization = Organization::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $organization,
            'message' => 'Organization fetched successfully'
        ], 200);
    }

    /**
     * Update the specified organization in database.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrganizationRequest $request, $id)
    {
        // Find organization record
        $organization = Organization::findOrFail($id);

        // Update organization record
        $organization->update($request->validated());

        return response()->json([
            'success' => true,
            'data'    => $organization,
            'message' => 'Organization updated successfully'
        ], 200);
    }

    /**
     * Soft delete the specified organization.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find organization or fail
        $organization = Organization::findOrFail($id);

        // Soft delete the organization
        $organization->delete();

        return response()->json([
            'success' => true,
            'message' => 'Organization deleted successfully'
        ], 200);
    }

    /**
     * List Users of an organization.
     *
     * @param  int  $organizationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function users($organizationId)
    {
        $organization = Organization::with('users')->findOrFail($organizationId);

        return response()->json([
            'success' => true,
            'data'    => $organization->users,
            'message' => 'Users of organization fetched successfully'
        ], 200);
    }
}
