<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public $timestamps = true;
    protected $fillable = ['name'];

    public static function createDomain(array $params)
    {
        $domain = new self();
        $domain->name = $params['url'];
        $domain->status = $params['status'];
        $domain->header = $params['header'];
        $domain->body = $params['body'];
        $domain->h1 = $params['h1'];
        $domain->keywords = $params['keywords'];
        $domain->description = $params['description'];
        $domain->save();
        return $domain->id;
    }

    public static function getDomain(int $idDomain)
    {
        $domain = Domain::where('id', '=', $idDomain)->first();
        return $domain;
    }

    public static function getAllDomains()
    {
        $domains = Domain::paginate(15);
        return $domains;
    }
}
