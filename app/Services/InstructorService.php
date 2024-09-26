<?php
namespace App\Services;

use App\Models\Instructor;

class InstructorService
{
    /**
     *  getAllInstructors wiyh realation courses
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllInstructors()
    {
        return Instructor::with('courses')->get();
    }
    /**
     * createInstructor and attached the relation courses
     * @param array $data
     * @return Instructor|\Illuminate\Database\Eloquent\Model
     */
    public function createInstructor(array $data)
    {

        $instructor = Instructor::create($data);


        if (isset($data['courses']) && is_array($data['courses'])) {
            $instructor->courses()->attach($data['courses']); // Array of course IDs
        }

        return $instructor->load('courses');
    }
    /**
     * updateInstructor and sync relation courses
     * @param array $data
     * @param mixed $id
     * @return Instructor|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function updateInstructor(array $data, $id)
    {
        $instructor = Instructor::findOrFail($id);

        $instructor->update($data);

        if (isset($data['courses']) && is_array($data['courses'])) {
            $instructor->courses()->sync($data['courses']); // Sync courses if provided
        }

        return $instructor->load('courses');
    }
    /**
     * deleteInstructor
     * @param mixed $id
     * @return string[]
     */
    public function deleteInstructor($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        return ['message' => 'Instructor deleted'];
    }
}
