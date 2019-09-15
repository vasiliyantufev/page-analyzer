<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Domain;
use DiDom\Document;

class DomainJob extends Job
{
    protected $domain;
    protected $stateMachine;

    public function __construct(Domain $domain, $stateMachine)
    {
        $this->domain = $domain;
        $this->stateMachine = $stateMachine;
    }

    public function handle(Client $client)
    {
        $this->stateMachine->apply('run');
        try {
            $guzzleClient = $client->request('GET', $this->domain->getOriginal('name'));
            //----------guzzle---------//
            $this->domain->status = $guzzleClient->getStatusCode();
            $this->domain->header = $guzzleClient->getHeader('content-type')[0];
            $this->domain->content_length = strlen($guzzleClient->getBody());
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
            $this->stateMachine->apply('success');
            $this->domain->state = $this->stateMachine->getCurrentState()->getName();
            $this->domain->save();
        } catch (\Exception $error) {
            $this->stateMachine->apply('failure');
            $this->domain->state = $this->stateMachine->getCurrentState()->getName();
            $this->domain->save();
        }
    }
}
