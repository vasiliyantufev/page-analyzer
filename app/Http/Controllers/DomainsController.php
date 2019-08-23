<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Domain;

class DomainsController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|url'
        ]);

        $url = $request->get('name');

        $guzzleClient = $this->client->request('GET', $url);

        $params['url'] = $url;
        $params['status'] = $guzzleClient->getStatusCode();
        $params['header'] = $guzzleClient->getHeader('content-type')[0];
        $params['body'] = $guzzleClient->getBody();

        $idDomain = Domain::createDomain($params);

        return redirect('domains/'.$idDomain);
    }

    public function show(int $domainId)
    {
        $domain = Domain::getDomain($domainId);
        return view('info',[
            'domain' => $domain
        ]);
    }

    public function all()
    {
        $domains = Domain::getAllDomains();
        return view('list',[
            'domains' => $domains
        ]);
    }
}
