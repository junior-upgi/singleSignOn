<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRouteExists()
    {
        $this->call('GET', '/');
        //$this->assertResponseOk();

        $this->call('POST', 'login');
        //$this->assertResponseOk();
        
        $this->call('GET', 'logout');
        //$this->assertResponseOk();

        $this->call('GET', 'abc');
        //$this->assertResponseOk();
    }
}
