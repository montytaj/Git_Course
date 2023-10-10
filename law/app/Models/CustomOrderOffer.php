<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CustomOrder;

class CustomOrderOffer extends Model
{
    use HasFactory;
    protected $table = "custom_order_offers";
    protected $fillable = [
					        'OfferID','CustomOrderID','CustomerID','LawyerID','LawyerType',
					        'Description','Execution_Period','Price','Tax',
					        'PlatformCommission','TotalAmount','Status',
					        'OfferDate','OfferTime','OfferDateTime',
					        'LawyerUpdateDate','LawyerDeleteDate','DUserID','DDate'
    ];
    public $timestamps = false;
    public function orders() {
        return $this->belongsTo(CustomOrder::class, 'CustomOrderID','CustomOrderID');
    }//END public function orders()
    public function lawyers() {
        return $this->belongsTo(Lawyer::class, 'LawyerID','LawyerID');
    }//END public function lawyers()
    public function customers() {
        return $this->belongsTo(Customer::class, 'CustomerID','CustomerID');
    }//END public function customers()
    
}//END class CustomOrderOffer extends Model
