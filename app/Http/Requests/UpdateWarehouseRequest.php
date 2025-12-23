<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateWarehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'    => 'sometimes|required|string|max:255|unique:warehouses,name,' . $this->warehouse,
            'code'    => 'sometimes|required|string|max:50|unique:warehouses,code,' . $this->warehouse,
            'address' => 'nullable|string',
            'city'    => 'nullable|string',
            'state'   => 'nullable|string',
            'country' => 'nullable|string',
        ];
    }

    /**
     * Handle a failed validation attempt and return a standardized JSON response.
     *
     * This method overrides the default FormRequest validation failure behavior
     * to ensure all validation errors are returned in a consistent API-friendly
     * JSON structure with proper HTTP status codes.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
    */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'error', // <-- custom status,
            'status_code' => 422,
            'message' => $validator->errors()->count() . ' validation error(s)',
            'errors' => $validator->errors()
        ], 422); // HTTP status code

        throw new HttpResponseException($response);
    }
}
