<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreInstructorRequest extends FormRequest
{
    /**
     * Authorization check.
     */
    public function authorize()
    {
        return true; // Modify as needed if there's an authentication system
    }

    /**
     * Validation rules.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'specialty' => 'nullable|string|max:255',
            'courses' => 'sometimes|array',
            'courses.*' => 'exists:courses,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'name.required' => 'The instructor name is required.',
            'name.string' => 'The instructor name must be a string.',
            'name.max' => 'The instructor name must not exceed 255 characters.',
            'experience.required' => 'The experience is required.',
            'experience.integer' => 'The experience must be a valid number.',
            'experience.min' => 'The experience must be a positive number.',
            'specialty.string' => 'The specialty must be a string.',
            'specialty.max' => 'The specialty must not exceed 255 characters.',
            'courses.required' => 'At least one course must be selected.',
            'courses.*.exists' => 'The selected course does not exist.',
        ];
    }

    /**
     * Custom field names for error messages.
     */
    public function attributes()
    {
        return [
            'name' => 'instructor name',
            'experience' => 'experience',
            'specialty' => 'specialty',
            'courses' => 'courses',
        ];
    }

    /**
     * Handle logic when validation passes.
     */
    protected function passedValidation()
    {
         $this->merge(['specialty' => strtoupper($this->specialty)]);
    }

    /**
     * Handle logic when validation fails.
     */
    protected function failedValidation(Validator $validator)
    {
        // Customize the response when validation fails, like returning a JSON response.
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Invalid data provided.',
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
