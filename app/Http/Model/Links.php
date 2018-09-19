<?php

namespace App\Http\model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    protected $primaryKey ='link_id';
    public $timestamps = false;
    protected $guarded = [];
}
