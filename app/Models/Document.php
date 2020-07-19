<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['document', 'user_id', 'date_exp'];
    protected $table = 'document';
}
