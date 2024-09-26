<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    /**
     *get all courses with realation instructors

     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllCourses()
    {
        return Course::with('instructors')->get();
    }
    /**
     *
     * creat course and attached the realation  instructors
     * @param array $data
     * @return Course|\Illuminate\Database\Eloquent\Model
     */
    public function createCourse(array $data)
    {
        $course = Course::create($data);

        if (isset($data['instructors']) && is_array($data['instructors'])) {
            $course->instructors()->attach($data['instructors']); // Array of instructor IDs
        }

        return $course->load('instructors');
    }
    /**
     * updateCourse and sync the realation instructors
     * @param array $data
     * @param mixed $id
     * @return Course|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateCourse(array $data, $id)
    {
        $course = Course::findOrFail($id);


        $course->update($data);


        if (isset($data['instructors']) && is_array($data['instructors'])) {
            $course->instructors()->sync($data['instructors']); // Sync instructors if provided
        }

        return $course->load('instructors');
    }
    /**
     *  deleteCourse
     * @param mixed $id
     * @return string[]
     */
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return ['message' => 'Course deleted'];
    }
}
