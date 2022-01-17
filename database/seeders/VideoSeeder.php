<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Video;
        $post->user_id = 1; //The official afropolis
        $post->category_id = 1;
        $post->interest_id = 1;
        $post->title = 'Welcome to afropolis!';
        $post->sub_title = 'Welcome to afropolis!';
        $post->video_url = 'rooms/video/video/1.mp4';
        $post->image_url = 'rooms/video/cover/1.jpg';
        $post->save();

        $post = new Video;
        $post->user_id = 2; //The official afropolis
        $post->category_id = 2;
        $post->interest_id = 1;
        $post->title = 'Dance Video';
        $post->sub_title = 'The afropolis dance video!';
        $post->video_url = 'rooms/video/video/2.mp4';
        $post->image_url = 'rooms/video/cover/2.jpg';
        $post->save();

        $post = new Video;
        $post->user_id = 1; //The official afropolis
        $post->category_id = 1;
        $post->interest_id = 1;
        $post->title = 'Crump Video!';
        $post->sub_title = 'The afropolis crump video!';
        $post->video_url = 'rooms/video/video/3.mp4';
        $post->image_url = 'rooms/video/cover/3.jpg';
        $post->save();

        $post = new Video;
        $post->user_id = 6; //The official afropolis
        $post->category_id = 2;
        $post->interest_id = 1;
        $post->title = 'Song Video';
        $post->sub_title = 'The afropolis song video!';
        $post->video_url = 'rooms/video/video/4.mp4';
        $post->image_url = 'rooms/video/cover/4.jpg';
        $post->save();
    }
}
