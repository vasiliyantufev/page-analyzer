<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    public $timestamps = true;
    protected $fillable = ['name'];

    public static function createDomain(string $name)
    {
        $domain = new self();
        $domain->name = $name;
        $domain->save();
        return $domain->id;
    }

    public static function getDomain(int $idDomain)
    {
        $domain = Domains::where('id', '=', $idDomain)->first();
        return $domain;
    }


}
