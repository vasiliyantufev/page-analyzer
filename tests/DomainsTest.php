<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DomainsTest extends TestCase
{

    public function testHome()
    {
        $this->get('/')->assertResponseOk();
    }

    public function testInfo()
    {
        $this->get('domains/1')->assertResponseOk();
    }
}
