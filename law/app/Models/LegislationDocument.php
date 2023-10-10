<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegislationDocument extends Model
{
    use HasFactory;
    protected $table = "legislation_documents";
    protected $fillable = [
    	'LegislationDocumentPrimary',
	    'SubjectID','SubjectType',
	    'LegislationDocumentPath'
    ];
    public $timestamps = false;
}//END class LegislationDocument extends Model
