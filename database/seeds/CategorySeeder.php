<?php

use Illuminate\Database\Seeder;
use App\Helpers\Image;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Laravel" => "F35144",
            "Node.js" => "8DBC58",
            "Vuejs" => "41B881",
            "React" => "0CC1E9",
            "Deno" => "0098B6",
            "Amplify" => "FF9733",
        ];
        foreach($categories as $category => $bg) {
            factory(\App\Models\Category::class)->create([
                "name" => $category,
                "picture" => Image::image(storage_path('app/public/categories'), $category, $bg, 850, 350, false),
            ]);
        }
    }
}
