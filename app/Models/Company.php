<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Company extends Model
{
    protected $guarded = [];
    protected $attributes = [
        'feeQuantityRange' => '[
            {
                "fee" : 10
            },
            {
                "fee" : 10
            },
            {
                "fee" : 10
            },
            {
                "fee" : 10
            },
            {
                "fee" : 10
            },
            {
                "fee" : 10
            },
            {
                "fee" : 10
            }
        ]'
    ];
    protected $table = 'company';
    
}
