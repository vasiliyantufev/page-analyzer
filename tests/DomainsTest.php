<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class DomainsTest extends TestCase
{

    public function testHome()
    {
        $this->get('/')->assertResponseOk();
    }

    public function testAll()
    {
        $this->get('/domains')->assertResponseOk();
    }

    public function testDomainCreateAndView()
    {
        $domain = factory('App\Domain')->create();
        $this->seeInDatabase('domains', $domain->getOriginal());
        $this->get('domains/' . $domain->id)->assertResponseOk();
    }

    public function testForm()
    {
        $param = ['name' => 'http://yandex.ru'];
        $this->post('/domains', $param);
        $this->seeInDatabase('domains', $param);
    }

    public function testGuzzle()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar']),
            new Response(202, ['Content-Length' => 0]),
            new RequestException("Error Communicating with Server", new Request('GET', 'test'))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // The first request is intercepted with the first response.
        $this->assertEquals($client->request('GET', '/')->getStatusCode(), 200);
        // The second request is intercepted with the second response.
        $this->assertEquals($client->request('GET', '/')->getStatusCode(), 202);
    }
}
