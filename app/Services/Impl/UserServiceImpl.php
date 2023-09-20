<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $users = [
        "alsyam" => "rahasia"
    ];

    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
        // cara lain
        // if ($password == $correctPassword) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
}
