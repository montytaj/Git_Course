<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
					        'CustomerID','FirstName','LastName',
					        'CityID','PhoneNumber','Email',
					        'Password','Status','CDate','UDate'
    ];
    public $timestamps = false;

    public function city() {
        return $this->belongsTo(City::class, 'CityID','CityID');
    }//END public function city()
}
