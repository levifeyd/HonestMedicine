<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Repositories\ItemRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
     private $token;
    /**
     * A basic feature test example.
     *
     * @return void
     */

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
    public function testShowAllApi() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('api/show-all');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',null);
        $response->assertJsonPath('success',true);
        self::assertEquals(2, count($content['data']));
    }
    public function testShowApi() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('api/show/1');
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',null);
        $response->assertJsonPath('success',true);
        self::assertEquals("test", $content['data']['name']);
        self::assertEquals("1", $content['data']['key']);
    }
    public function testShowApiError() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('api/show/10');
        $response->assertStatus(500);
        $response->assertJsonPath('message',"Item doesnt exist");
        $response->assertJsonPath('success',false);
    }
    public function testUpdateApi() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->put('api/update/1', ['name'=>'update test', 'key'=>'update test']);
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',"Success, item updated!");
        $response->assertJsonPath('success',true);
        self::assertEquals("update test", $content['data']['name']);
        self::assertEquals("update test", $content['data']['key']);
//        (new UserRepository())->updateById(2, ['name'=>'test2','key'=>2]);
        Item::query()->where('name', 'update test')->update(['name'=>'test2','key'=>2]);
    }
    public function testUpdateApiErrorKey() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->put('api/update/3', ['name'=>'update test']);
        $response->assertStatus(500);
        $response->assertJsonPath('success',false);
        $response->assertJsonPath('message',"Validation error");
    }
    public function testUpdateApiItemNotExist() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->put('api/update/10', ['name'=>'update test', 'key'=>"123"]);
        $response->assertStatus(500);
        $response->assertJsonPath('message',"Item doesnt exist");
        $response->assertJsonPath('success',false);
    }
    public function testStoreApi() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('api/store', ['name'=>'store test', 'key'=>'store test']);
        $content = json_decode($response->getContent(), true);
        $response->assertStatus(200);
        $response->assertJsonPath('message',"Success, item stored!");
        $response->assertJsonPath('success',true);
        self::assertEquals("store test", $content['data']['name']);
        self::assertEquals("store test", $content['data']['key']);
        Item::query()->find($content['data']['id'])->delete();
    }
    public function testItemRequestValidationError() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('api/store', ['name'=>'store test']);
        $response->assertStatus(500);
        $response->assertJsonPath('success',false);
        $response->assertJsonPath('message',"Validation error");
    }
    public function testDeleteApi() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('api/delete/1');
        $response->assertStatus(200);
        $response->assertJsonPath('message',"Success, item deleted!");
        $response->assertJsonPath('success',true);
        Item::query()->create(['name'=>'test', "key"=>1]);
    }
    public function testDeleteApiItemNotExist() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('api/delete/10');
        $response->assertStatus(500);
        $response->assertJsonPath('message',"Item doesnt exist");
        $response->assertJsonPath('success',false);
    }
}
