<?php

namespace Tests\Feature;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ApIItemControllerUpdateTest extends TestCase
{
    protected Authenticatable|Model $user;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = (new UserRepository())->getById(1);
    }
    public function testUpdateApi() {
        $response = $this->putRequestToRouteUpdate('api/update/2');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',"Success, item updated!");
        $response->assertJsonPath('success',true);
        self::assertEquals("update test", $content['data']['name']);
        self::assertEquals("update test", $content['data']['key']);
    }
    public function testUpdateApiErrorKey() {
        $response = $this->putRequestToRouteUpdate('api/update/3', false);
        $response->assertStatus(500);
        $response->assertJsonPath('success',false);
        $response->assertJsonPath('message',"Validation error");
    }
    public function testUpdateApiItemNotExist() {
        $response = $this->putRequestToRouteUpdate('api/update/10');
        $response->assertStatus(500);
        $response->assertJsonPath('message',"Item doesnt exist");
        $response->assertJsonPath('success',false);
    }

    private function putRequestToRouteUpdate($uri, $key = true): TestResponse {
        return $key ? $this->actingAs($this->user)->withSession(['banned' => false])
            ->put($uri, ['name'=>'update test', 'key'=>"update test"]) :
            $this->actingAs($this->user)->withSession(['banned' => false])
                ->put($uri, ['name'=>'update test']);
    }

}
