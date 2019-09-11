<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Domain;
use DiDom\Document;

class DomainJob extends Job
{
    protected $domain;

    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    public function handle(Client $client)
    {
        $this->domain->pending();
        try{
            $guzzleClient = $client->request('GET', $this->domain->getOriginal('name'));
            //----------guzzle---------//
            $this->domain->status = $guzzleClient->getStatusCode();
            $this->domain->header = $guzzleClient->getHeader('content-type')[0];
            $headers = $guzzleClient->getHeader('Content-Length');
            $this->domain->content_length = empty($headers) ? null : $headers[0];
            $this->domain->body = $guzzleClient->getBody();
            //----------DiDom----------//
            $document = new Document($this->domain->getOriginal('name'), true);
            $document->has('h1::text') ? $params['h1'] = $document->first('h1::text') : $params['h1'] = '';
            $document->has('meta[name=keywords]::attr(content)') ?
                $this->domain->keywords = $document->first('meta[name=keywords]::attr(content)') :
                $this->domain->keywords = 'no keywords';
            $document->has('meta[name=description]::attr(content)') ?
                $this->domain->description = $document->first('meta[name=description]::attr(content)') :
                $this->domain->description = 'no description';
            $this->domain->save();
            $this->domain->completed();
        }
        catch (\Exception $error) {
            $this->domain->failed();
            $this->domain->save();
        }
    }
}
