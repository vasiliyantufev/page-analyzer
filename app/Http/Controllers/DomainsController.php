<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains;
use GuzzleHttp\Client;

class DomainsController extends Controller
{
    private $guzzleClient;

    public function __construct(Client $client)
    {
        $this->guzzleClient = $client;
    }

    public function create(Request $request)
    {
        $idDomain = Domains::createDomain($request->get('name'));
        return redirect('domains/'.$idDomain);
    }

    public function show(int $domainId)
    {
        $domain = Domains::getDomain($domainId);
        return view('info',[
            'domain' => $domain
        ]);
    }

    public function all()
    {
        $domains = Domains::getAllDomains();
        return view('list',[
            'domains' => $domains
        ]);
//        dd($domains);
    }
}
