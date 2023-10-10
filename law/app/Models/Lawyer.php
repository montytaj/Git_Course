<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;
    protected $table = "lawyers";
    protected $fillable = [
					        'LawyerID','FirstName','LastName','AccountID',
					        'QualificationID','Specialism','LicenseType',
					        'LicensePath','Experience',
					        'CityID','PhoneNumber','Email','Password',
					        'FieldID','Status','CDate','UDate'
    ];
    public $timestamps = false;
   
    public function qualification() {
    	return $this->belongsTo(Qualification::class, 'QualificationID','QualificationID');
    }//END public function qualification()

    public function fields() {
        return $this->belongsTo(Field::class, 'FieldID','FieldID');
    }//END public function fields()

    public function city() {
        return $this->belongsTo(City::class, 'CityID','CityID');
    }//END public function city()
    public function offers() {
        return $this->belongsTo(CustomOrderOffer::class, 'LawyerID','LawyerID');
    }//END public function offers()
}
