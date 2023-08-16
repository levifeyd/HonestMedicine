<?php

namespace Tests\Feature;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function testHomePage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

}
