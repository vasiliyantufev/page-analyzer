<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as Resp;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DomainsControllerTest extends TestCase
{
    use DatabaseMigrations;

    const PATH_FILES = 'tests' . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR;
    const URL = 'http://domains.com';
    const CONTENT_LENGTH = 661;

    private function getFilePath(string $filename = '')
    {
        return self::PATH_FILES . $filename;
    }

    protected function setUp():void
    {
        parent::setUp();
        $content = file_get_contents(self::getFilePath('example.html'), true);
        $mock = new MockHandler([
            new Response(Resp::HTTP_OK, ['Content-Length' => self::CONTENT_LENGTH], $content)
        ]);
        $handler = HandlerStack::create($mock);
        $this->app->bind('GuzzleHttp\Client', function ($app) use ($handler) {
            return new Client(['handler' => $handler]);
        });
    }

    public function testIndex()
    {
        $this->get(route('domains.index'))->assertResponseOk();
    }

    public function testShow()
    {
        $domain = factory('App\Domain')->create();
        $this->get(route('domains.show', ['id' => $domain->id]))->assertResponseOk();
    }

    public function testStore()
    {
        $param = ['name' => self::URL];
        $this->post(route('domains.store'), $param);
        $this->seeInDatabase('domains', $param);
    }
}
