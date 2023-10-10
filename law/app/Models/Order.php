<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
					        'OrderID','ServiceID','ServiceType','PaymentID','PaymentTime','CurrentPrice','BuyerName',
					        'BuyerEmail','BuyerPhone','Status',
					        'OrderTime','UserResever',
					        'ReseverTime','UserDone','DoneTime'
    ];
    public $timestamps = false;

    public function service(){

  	return $this->belongsTo(Service::class, 'ServiceID','ServiceID');

  }//END public function user_receiver()
}//END class Order extends Model
