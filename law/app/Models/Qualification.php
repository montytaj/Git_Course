<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $table = "qualifications";
    protected $fillable = [
					        'QualificationID','QualificationName',
					        'Status',
					        'CUserID','CDate',
					        'UUserID','UDate'
    ];
    public $timestamps = false;
}
