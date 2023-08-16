<?php

namespace Tests\Feature;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ApIItemControllerShowTest extends TestCase
{
    protected Authenticatable|Model $user;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = (new UserRepository())->getById(1);
    }
    public function testShowAllApi() {
        $response = $this->getRequestToRoute('api/show-all');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',null);
        $response->assertJsonPath('success',true);
        self::assertCount(1, $content['data']);
    }
    public function testShowApi() {
        $response = $this->getRequestToRoute('api/show/2');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',null);
        $response->assertJsonPath('success',true);
        self::assertEquals("test2", $content['data']['name']);
        self::assertEquals("2", $content['data']['key']);
    }
    public function testShowApiError() {
        $response = $this->getRequestToRoute('api/show/10');
        $response->assertStatus(500);
        $response->assertJsonPath('message',"Item doesnt exist");
        $response->assertJsonPath('success',false);
    }

    private function getRequestToRoute(string $route): TestResponse {
        return $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get($route);
    }

}
