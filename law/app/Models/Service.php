<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";
    protected $fillable = [
					        'ServiceID','ServiceName',
					        'ServiceType','ServiceDetails',
					        'ServicePrice','ServiceImage','Status',
					        'CUserID','CDate',
					        'UUserID','UDate'
    ];
    public $timestamps = false;
}//END class Service extends Model
