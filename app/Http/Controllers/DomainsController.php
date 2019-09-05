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

    public function store(Request $request)
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
        $document->has('meta[name=keywords]::attr(content)') ?
            $params['keywords'] = $document->first('meta[name=keywords]::attr(content)') :
            $params['keywords'] = 'no keywords';
        $document->has('meta[name=description]::attr(content)') ?
            $params['description'] = $document->first('meta[name=description]::attr(content)') :
            $params['description'] = 'no description';

        $domain = Domain::create([
            'name' => $params['url'],
            'status' => $params['status'],
            'header' => $params['header'],
            'body' => $params['body'],
            'h1' => $params['h1'],
            'keywords' => $params['keywords'],
            'description' => $params['description']
        ]);

        return redirect('domains/' . $domain->id);
    }

    public function show(int $domainId)
    {
        $domain = Domain::find($domainId);
        return view('info', [
            'domain' => $domain
        ]);
    }

    public function index()
    {
        $domains = Domain::paginate(15);
        return view('list', [
            'domains' => $domains
        ]);
    }
}
