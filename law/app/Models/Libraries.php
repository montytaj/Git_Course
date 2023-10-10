<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\LegislationDocument;

class Libraries extends Model
{
    use HasFactory;
    protected $table = "library";
    protected $fillable = [
					        'SubjectID','SubjectType','FieldID',
					        'Author','Title',
					        'Content','FromDate',
					        'ToDate','Status',
					        'CUserID','CDate',
					        'UUserID','UDate'
    ];
    public $timestamps = false;

  public function documents() {
      return $this->hasMany(LegislationDocument::class, 'SubjectID','SubjectID');
  }//END public function documents()
  public function fields(){
    return $this->belongsTo(Field::class, 'FieldID','FieldID');
  }//END public function fields()



}// class Libraries extends Model


