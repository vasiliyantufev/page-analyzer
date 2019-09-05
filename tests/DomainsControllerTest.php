<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as Resp;

class DomainsControllerTest extends TestCase
{
    const PATH_FILES = 'tests' . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR;
    const URL = 'http://domains.com';

    private function getFilePath(string $filename = '')
    {
        return self::PATH_FILES . $filename;
    }

    public function testControllerIndex()
    {
        $this->get(route('domains.index'))->assertResponseOk();
    }

    public function testControllerShow()
    {
        $domain = factory('App\Domain')->create();
        $this->seeInDatabase('domains', $domain->getOriginal());
        $this->get(route('domains.show', ['id' => $domain->id]))->assertResponseOk();
    }

    public function testControllerStore()
    {
        $param = ['name' => self::URL];
        $this->post(route('domains.store'), $param);
        $this->seeInDatabase('domains', $param);
    }

    public function testMockBody()
    {
        $content = file_get_contents(self::getFilePath('example.html'), true);

        $mock = new MockHandler([
            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(Client::class, $client);

        $this->assertEquals($client->request('POST', route('domains.store'))->getBody(), $content);
    }

    public function testMockStatusCode()
    {
        $content = file_get_contents(self::getFilePath('example.html'), true);

        $mock = new MockHandler([
            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $this->app->instance(Client::class, $client);

        $this->assertEquals($client->request('POST', route('domains.store'))->getStatusCode(), Resp::HTTP_OK);
    }
}
