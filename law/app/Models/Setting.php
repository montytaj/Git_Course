<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $fillable = [
					        'PlatformCommission','Tax',
					        'Status','CUserID','CDate',
					        'UUserID','UDate','DUserID','DDate'
    ];
    public $timestamps = false;
}
