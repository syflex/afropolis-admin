<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = new Collection;
        $collection->user_id = 1; //The official afropolis
        $collection->name = "testing collection";
        $collection->description = "the official afropolis";
        $collection->image = '1.jpg';
        $collection->save();

        $collection = new Collection;
        $collection->user_id = 1; //The official afropolis
        $collection->name = "testing";
        $collection->description = "the official afropolis";
        $collection->image = '1.jpg';
        $collection->save();

        $collection = new Collection;
        $collection->user_id = 1; //The official afropolis
        $collection->name = "teser";
        $collection->description = "the official afropolis";
        $collection->image = '1.jpg';
        $collection->save();

        $collection = new Collection;
        $collection->user_id = 1; //The official afropolis
        $collection->name = "test";
        $collection->description = "the official afropolis";
        $collection->image = '1.jpg';
        $collection->save();
    }
}
