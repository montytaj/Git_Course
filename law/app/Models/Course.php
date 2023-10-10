<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $fillable = [
					        'CourseID','CourseName',
					        'CoursePresenter','CourseDate',
					        'CourseHours','CourseType',
					        'CourseLink','CourseImage',
					        'CoursePresenterImage','CourseLogo',
					        'Status','CUserID','CDate',
					        'UUserID','UDate'
    ];
    public $timestamps = false;
}//END class Course extends Model
