<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public $timestamps = true;
    protected $fillable = ['name', 'status', 'header', 'body', 'h1', 'keywords', 'description'];
}
