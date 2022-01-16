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
        $collection->user_id = 2;
        $collection->name = "Testing collection";
        $collection->description = "the official afropolis";
        $collection->image_url = 'rooms/collections/2/room1.jpeg';
        $collection->save();

        $collection = new Collection;
        $collection->user_id = 2;
        $collection->name = "The Dance Collectiom";
        $collection->description = "The Dance Collectiom description";
        $collection->image_url = 'rooms/collections/2/room1.jpeg';
        $collection->save();

        $collection = new Collection;
        $collection->user_id = 2;
        $collection->name = "Crump Collection";
        $collection->description = "Crump Collection description";
        $collection->image_url = 'rooms/collections/2/room1.jpeg';
        $collection->save();
    }
}
