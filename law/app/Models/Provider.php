<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $table = "providers";
    protected $fillable = [
					        'ProviderID','ProviderName','ProviderType',
					        'Address','LicensePath','AccountID',
					        'CityID','PhoneNumber','Email',
					        'Password','Status','CDate','UDate'
    ];
    public $timestamps = false;

    public function city() {
        return $this->belongsTo(City::class, 'CityID','CityID');
    }//END public function city()
}
