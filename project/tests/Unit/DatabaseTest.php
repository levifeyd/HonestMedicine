<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function testHasUser() {
        $this->assertDatabaseHas('users', ['name' => 'artem']);
    }
    public function testHasItem() {
        $this->assertDatabaseHas('items', ['name' => 'test']);
    }

    public function testCountUser() {
        $this->assertDatabaseCount('users', 1);
    }
}
