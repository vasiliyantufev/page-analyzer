<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    public $timestamps = true;
    protected $fillable = ['name'];


    public static function createDomain(string $name)
    {
        $client = new Client();
        $guzzleClient = $client->request('GET', $name);

        $domain = new self();
        $domain->name = $name;
        $domain->status = $guzzleClient->getStatusCode();
        $domain->header = $guzzleClient->getHeader('content-type')[0];
        $domain->body = $guzzleClient->getBody();
        $domain->save();
        return $domain->id;
    }

    public static function getDomain(int $idDomain)
    {
        $domain = Domains::where('id', '=', $idDomain)->first();
        return $domain;
    }

    public static function getAllDomains()
    {
        $domains = Domains::paginate(15);
        return $domains;

        //return view('user.index', ['users' => $users]);
    }

}
