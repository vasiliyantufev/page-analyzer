<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Domain;
use DiDom\Document;

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

        //----------------------seo
        $document = new Document($url, true);
        $document->has('h1::text') ? $params['h1'] = $document->first('h1::text') : $params['h1'] = '';
        $document->has('meta[name=keywords]::attr(content)') ? $params['keywords'] = $document->first('meta[name=keywords]::attr(content)') : $params['keywords'] = '';
        $document->has('meta[name=description]::attr(content)') ? $params['description'] = $document->first('meta[name=description]::attr(content)') : $params['description'] = '';

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

//    public function test()
//    {
//        $document = new Document('https://www.drclinics.ru', true);
//        $h1 = $document->first('h1::text');
//        $title = $document->first('title::text');
//        $keywords = $document->first('meta[name=keywords]::attr(content)');
//        $descriptions = $document->first('meta[name=description]::attr(content)');
//
//        print_r($h1);
//        echo '</br>';
//        print_r($title);
//        echo '</br>';
//        print_r($keywords);
//        echo '</br>';
//        print_r($descriptions);
//    }
}
