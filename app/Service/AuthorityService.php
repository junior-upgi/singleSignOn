<?php
namespace App\Service;

use App\Respositories\AuthorityRepository;

class AuthorityService
{
    public $auth;

    public function __construct(AuthorityRepository $auth)
    {
        $this->auth = $auth;
    }
}