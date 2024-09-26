<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Services\InstructorService;

class InstructorController extends Controller
{
    protected $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    public function index()
    {
        $instructors = $this->instructorService->getAllInstructors();
        return response()->json($instructors);
    }

    public function store(StoreInstructorRequest $request)
    {
        $instructor = $this->instructorService->createInstructor($request->validated());
        return response()->json($instructor, 201);
    }

    public function update(UpdateInstructorRequest $request, $id)
    {
        $instructor = $this->instructorService->updateInstructor($request->validated(), $id);
        return response()->json($instructor);
    }

    public function destroy($id)
    {
        $message = $this->instructorService->deleteInstructor($id);
        return response()->json($message);
    }
}
