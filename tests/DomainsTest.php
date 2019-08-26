<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
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
        $param = ['name' => self::URL];
        $this->post('/domains', $param);
        $this->seeInDatabase('domains', $param);
    }

//    public function testMock()
//    {
//        $content = file_get_contents(self::getFilePath('example.html'), true);
//
//        $mock = new MockHandler([
//            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content),
//            new Response(Resp::HTTP_OK, ['Content-Length' => 661], $content)
//        ]);
//
//        $handler = HandlerStack::create($mock);
//        $client = new Client(['handler' => $handler]);
//        $this->app->instance(Client::class, $client);
//
//        $this->assertEquals($client->request('POST', '/domains')->getBody(), $content);
//        $this->assertEquals($client->request('POST', '/domains')->getStatusCode(), Resp::HTTP_OK);
//    }
}
