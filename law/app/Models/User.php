<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = [
					        'UserID','FullName','Email',
					        'PhoneNumber','Email','Password',
					        'Status','CUserID','CDate',
					        'UDate','UUserID','UDate'
    ];
    public $timestamps = false;
}
