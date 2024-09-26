<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateInstructorRequest extends FormRequest
{
    /**
     * Authorization check.
     */
    public function authorize()
    {
        return true; // Modify this as needed for authorization logic
    }

    /**
     * Validation rules.
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'experience' => 'sometimes|required|integer|min:0',
            'specialty' => 'nullable|string|max:255',
            'courses' => 'required|array',
            'courses.*' => 'exists:courses,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'name.required' => 'The instructor name is required when provided.',
            'name.string' => 'The instructor name must be a string.',
            'name.max' => 'The instructor name may not be greater than 255 characters.',
            'experience.required' => 'The instructor experience is required when provided.',
            'experience.integer' => 'The instructor experience must be an integer.',
            'experience.min' => 'The instructor experience must be at least 0.',
            'specialty.string' => 'The instructor specialty must be a string.',
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
            'experience' => 'instructor experience',
            'specialty' => 'instructor specialty',
            'courses' => 'courses',
        ];
    }

    /**
     * Handle logic when validation passes.
     */
    protected function passedValidation()
    {
        // Custom logic can be added here if needed.
    }

    /**
     * Handle logic when validation fails.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Invalid data provided.',
            'errors' => $validator->errors(),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
