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

    public function listOfJiriStudents($jiri): Collection|array|_IH_Attendance_C
    {
        return $this->jiri->students;
    }
    public function listOfJiriJurys($jiri): Collection|array|_IH_Attendance_C
    {
        return $this->jiri->evaluators;
    }
    public function listOfJiriProjects($jiri)
    {
        return $this->jiri->projects;
    }


}
