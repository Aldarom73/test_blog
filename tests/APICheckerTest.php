<?php

namespace App\Tests;

//use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class APICheckerTest extends WebTestCase // TestCase
{
    public function testGet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/get/1');

        $this->assertResponseIsSuccessful();
    }

    public function testPost()
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/add', 
        [
            'userId' => '1',
            'title' => 'Mi título',
            'body' => 'Érase una vez...',
        ]);

        $this->assertResponseIsSuccessful();
    }

}
