<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'testing', 'key' => '1'],
            ['name'=>'testing_2', 'key' => '2'],
        ];
        DB::table('items')->insert($data);
    }
}
