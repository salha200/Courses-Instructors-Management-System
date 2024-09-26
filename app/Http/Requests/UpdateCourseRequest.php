<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateCourseRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'instructors' => 'required|array',
            'instructors.*' => 'exists:instructors,id',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages()
    {
        return [
            'title.required' => 'The course title is required when provided.',
            'title.string' => 'The course title must be a string.',
            'title.max' => 'The course title may not be greater than 255 characters.',
            'description.string' => 'The course description must be a string.',
            'start_date.required' => 'The course start date is required when provided.',
            'start_date.date' => 'The start date must be a valid date.',
            'instructors.required' => 'At least one instructor must be selected.',
            'instructors.*.exists' => 'The selected instructor does not exist.',
        ];
    }

    /**
     * Custom field names for error messages.
     */
    public function attributes()
    {
        return [
            'title' => 'course title',
            'description' => 'course description',
            'start_date' => 'start date',
            'instructors' => 'instructors',
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
