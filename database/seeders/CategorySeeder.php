<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interest = [
            ['name' => 'Arts', 'description' => 'Learn the mystery of Creative Arts from the masters of the field.', 'avatar' => 'Arts.jpg', 'featured' => false],
            ['name' => 'Comedy', 'description' => 'Understand the art of Comedy, driving and exaggerating amusements to a happy ending ', 'avatar' => 'Comedy.jpg', 'featured' => false],
            ['name' => 'Culture', 'description' => 'Learn about the diverse ways of life of people across the world', 'avatar' => 'Culture.jpg', 'featured' => false],
            ['name' => 'Design', 'description' => 'Learn the science and art of Design', 'avatar' => 'Design.jpg', 'featured' => false],
            ['name' => 'Economics', 'description' => 'Learn all about the world' . "'s" . ' Economics from masters', 'avatar' => 'Economics.jpg', 'featured' => false],
            ['name' => 'Hospitality & Tourism', 'description' => 'Learn the art of maximizing recreations and leisure', 'avatar' => 'hospitality & tourism.jpg', 'featured' => false],
            ['name' => 'Branding & Design', 'description' => 'Learn how to distinctively promote yourself and brand for the best possible outcomes', 'avatar' => 'branding & design.jpg', 'featured' => false],
        ];
        DB::table('categories')->insert($interest);
    }
}
