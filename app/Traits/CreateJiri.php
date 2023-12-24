<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;

trait CreateJiri
{
    public function lastJiri()
    {
        return auth()->user()->jiris()->orderBy('created_at', 'desc')->first();
    }
    public function listOfJiriStudents(): Collection|array|_IH_Attendance_C
    {
        return $this->getLastJiri()->students;
    }
    public function listOfJiriJurys(): Collection|array|_IH_Attendance_C
    {
        return $this->getLastJiri()->evaluators;
    }
    public function listOfJiriProjects()
    {
        return $this->getLastJiri()->projects;
    }


}
