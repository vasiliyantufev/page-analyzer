<?php

class HomeTest extends TestCase
{
    public function testIndex()
    {
        $this->get(route('index'))->assertResponseOk();
    }
}
