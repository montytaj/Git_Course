<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Field;
use App\Models\CustomOrderOffer;
class CustomOrder extends Model
{
    use HasFactory;
    protected $table = "custom_orders";
    protected $fillable = [
					        'CustomOrderID','CustomerID','FieldID',
					        'CityID','Description',
					        'CustomerUpdateDate','Status',
					        'OrderDate','OrderTime','OrderDateTime',
					        'CustomerDeleteDate','DUserID','DDate'
    ];
    public $timestamps = false;

    public function cities() {
        return $this->belongsTo(City::class, 'CityID','CityID');
    }//END public function cities()
    public function fields() {
        return $this->belongsTo(Field::class, 'FieldID','FieldID');
    }//END public function fields()
    public function customers() {
        return $this->belongsTo(Customer::class, 'CustomerID','CustomerID');
    }//END public function customers()
    public function offers() {
        return $this->hasMany(CustomOrderOffer::class, 'CustomOrderID','CustomOrderID');
    }//END public function offers()
}//END class CustomOrder extends Model
