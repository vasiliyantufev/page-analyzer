<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as Resp;

class DomainsTest extends TestCase
{
    const PATH_FILES = 'tests' . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR;
    const URL = 'http://domains.com';

    private function getFilePath(string $filename = '')
    {
        return self::PATH_FILES . $filename;
    }

    public function testIndex()
    {
        $this->get(route('index'))->assertResponseOk();
    }

    public function testDomainsIndex()
    {
        $this->get(route('domains.index'))->assertResponseOk();
    }

    public function testDomainsShow()
    {
        $domain = factory('App\Domain')->create();
        $this->seeInDatabase('domains', $domain->getOriginal());

        //echo route('domains.show', ['id' => $domain->id]) ;

        $this->get(route('domains.show', ['id' => $domain->id]))->assertResponseOk();
    }

    public function testDomainsStore()
    {
        $param = ['name' => self::URL];
        $this->post(route('domains.store'), $param);
        $this->seeInDatabase('domains', $param);
    }

    public function testMock()
    {
        $content = file_get_contents(self::getFilePath('example.html'), true);

        $mock = new MockHandler([
            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content),
            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(Client::class, $client);

        $this->assertEquals($client->request('POST', route('domains.store'))->getBody(), $content);
        $this->assertEquals($client->request('POST', route('domains.store'))->getStatusCode(), Resp::HTTP_OK);
    }
}
