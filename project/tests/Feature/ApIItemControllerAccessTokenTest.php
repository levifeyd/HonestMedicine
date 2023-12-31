<?php

namespace Tests\Feature;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ApIItemControllerAccessTokenTest extends TestCase
{
    protected Authenticatable|Model $user;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = (new UserRepository())->getById(1);
    }
    public function testHomePage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testAccessTokenApi() {
        $response = $this->post('api/personal-access-tokens', ['email'=>'artem@mail.ru', 'password'=>'qweasdzxc']);
        $response->assertStatus(200);
        $response->assertJsonPath('message','Success');
    }

}
