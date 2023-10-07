<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText('login');
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "alsyam"
        ])->get("/login")
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "alsyam",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "alsyam");
    }
    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "alsyam"
        ])->post('/login', [
            "user" => "alsyam",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }
    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("User or Password is Required");
    }
    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or Password is Wrong");
    }
    public function testLogout()
    {
        $this->withSession([
            "user" => "alsyam"
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }
    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}
