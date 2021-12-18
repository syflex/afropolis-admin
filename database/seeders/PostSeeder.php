<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        'user_id','category_id','interest_id','title','description','video_url','image_url'
        $post = new Post;
        $post->user_id = 1; //The official afropolis
        $post->category_id = 1;
        $post->interest_id = 1;
        // $post->title = 'Welcome to afropolis!';
        $post->video_url = '1.mp4';
        $post->image_url = '1.jpg';
        $post->save();

        $post = new Post;
        $post->user_id = 2; //The official afropolis
        $post->category_id = 2;
        $post->interest_id = 1;
        // $post->title = 'Welcome to afropolis!';
        $post->video_url = '2.mp4';
        $post->image_url = '2.jpg';
        $post->save();

        $post = new Post;
        $post->user_id = 2; //The official afropolis
        $post->category_id = 1;
        $post->interest_id = 1;
        // $post->title = 'Welcome to afropolis!';
        $post->video_url = '3.mp4';
        $post->image_url = '3.jpg';
        $post->save();

        $post = new Post;
        $post->user_id = 2; //The official afropolis
        $post->category_id = 2;
        $post->interest_id = 1;
        // $post->title = 'Welcome to afropolis!';
        $post->video_url = '4.mp4';
        $post->image_url = '4.jpg';
        $post->save();
    }
}
