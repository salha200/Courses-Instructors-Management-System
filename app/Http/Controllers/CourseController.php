<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;
    /**
     * inject courseService in constructer
     * @param \App\Services\CourseService $courseService
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return response()->json($courses);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = $this->courseService->createCourse($request->validated());

        return response()->json($course, 201);
    }
    /**
     *  update course
     * @param \App\Http\Requests\UpdateCourseRequest $request
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $course = $this->courseService->updateCourse($request->validated(), $id);
        return response()->json($course);
    }
    /**
     *  destroy 
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $message = $this->courseService->deleteCourse($id);
        return response()->json($message);
    }
}
