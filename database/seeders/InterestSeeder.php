<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Interest;

class InterestSeeder extends Seeder
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
            ['name' => 'Entrepreneurship & StartUps', 'description' => 'Learn how to turn an idea into a successful enterprise ', 'avatar' => 'Entrepreneurship n StartUp.jpg', 'featured' => true],
            ['name' => 'Faith & Religion', 'description' => 'Learn about various religious beliefs and understand deity from diverse perspectives ', 'avatar' => 'Faith.jpg', 'featured' => true],
            ['name' => 'Family', 'description' => 'Learn proven skills and tricks on how to lead a blissful family', 'avatar' => 'Family.jpg', 'featured' => false],
            ['name' => 'Fashion & Style', 'description' => 'Learn about trending Fashion, Style and Pop culture.', 'avatar' => 'Fashion n Style.jpg', 'featured' => false],
            ['name' => 'Fitness', 'description' => 'Learn about your body type and suitable exercise routines for a healthier and longer life', 'avatar' => 'fitness.jpeg', 'featured' => false],
            ['name' => 'Food & Catering', 'description' => 'Learn about recipes and the magic of mouth watering meals from master chefs', 'avatar' => 'Food and Catering.jpg', 'featured' => false],
            ['name' => 'Health', 'description' => 'Learn all about healthy living - prevention and remedy', 'avatar' => 'Health.jpg', 'featured' => false],
            ['name' => 'Investment & Finance', 'description' => 'Master the use of money learning from successful mentors', 'avatar' => 'Investment & Finance.jpg', 'featured' => false],
            ['name' => 'Kids & Parenting', 'description' => 'Learn about children psychology and good parenting skills', 'avatar' => 'Kids n Parenting.jpg', 'featured' => false],
            ['name' => 'Leadership', 'description' => 'Master the art of leadership and awaken the leader in you', 'avatar' => 'Leadership.jpg', 'featured' => false],
            ['name' => 'Management', 'description' => 'Learn how to effectively manage resources', 'avatar' => 'Management.jpg', 'featured' => false],
            ['name' => 'Men', 'description' => 'Learn everything about being a man... a real man', 'avatar' => 'Men.jpg', 'featured' => false],
            ['name' => 'Music & Entertainment', 'description' => 'Learn from veterans in the entertainment sector', 'avatar' => 'Music n Entetainment.jpg', 'featured' => false],
            ['name' => 'Personal Development', 'description' => 'Take your life to a higher level of fulfillment and become the best version of yourself', 'avatar' => 'Personal Development.jpg', 'featured' => true],
            ['name' => 'Photography', 'description' => 'Learn about professional photography from real successful photo gurus', 'avatar' => 'Photography.jpg', 'featured' => false],
            ['name' => 'Politics & Government', 'description' => 'Learn about politics and policies that transformed and are transforming the world', 'avatar' => 'Politics n Government.jpg', 'featured' => false],
            ['name' => 'Relationships', 'description' => 'Learn how to build and groom a successful redlationship ', 'avatar' => 'Relationships.jpg', 'featured' => false],
            ['name' => 'Romance', 'description' => 'Learn the spice that keeps the groove on', 'avatar' => 'Romance.jpg', 'featured' => false],
            ['name' => 'Sports', 'description' => 'Learning everything about diverse kinds of sports across the world', 'avatar' => 'Sports.jpg', 'featured' => false],
            ['name' => 'Technology', 'description' => 'Learn about current technology and develop your passion ', 'avatar' => 'Technology.jpg', 'featured' => true],
            ['name' => 'Wedding & Marriage', 'description' => 'Wedding ceremony planning and marriage education', 'avatar' => 'Wedding n Marriage.jpg', 'featured' => false],
            ['name' => 'Women', 'description' => 'Read in on the never ending book of Women', 'avatar' => 'Women.jpg', 'featured' => false],
            ['name' => 'Beauty & Makeover', 'description' => 'Learn the secrets of brush stroke artistry in redefining beauty', 'avatar' => 'Beanty n Makeover.jpg', 'featured' => false],
            ['name' => 'Agribusiness', 'description' => 'Become a leading entrepreneur in the commerce of Agriculture, tapping into one of Africas most promising sectors', 'avatar' => 'agribusiness.jpg', 'featured' => true],
            ['name' => 'Hospitality & Tourism', 'description' => 'Learn the art of maximizing recreations and leisure', 'avatar' => 'hospitality & tourism.jpg', 'featured' => false],
            ['name' => 'Branding & Design', 'description' => 'Learn how to distinctively promote yourself and brand for the best possible outcomes', 'avatar' => 'branding & design.jpg', 'featured' => false],
        ];
        DB::table('interest')->insert($interest);
    }
}
