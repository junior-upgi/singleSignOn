<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShow()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
    }

    public function testSetShowParams()
    {
        $url = 'http://test.com';
        $this->call('GET', '/', ['url' => $url]);
        $this->assertResponseOk();
        $this->assertViewHas('url', $url);

        $this->call('GET', '/');
        $this->assertResponseOk();
        $this->assertViewHas('url', '');
    }

    public function testUserLogin()
    {
        $this->userLoggedIn();
        $url = 'http://test.com';
        $this-> call('GET', '/', ['url' => $url]);
        $this->assertResponseOk();
    }
}
