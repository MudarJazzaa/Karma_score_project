<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::factory(100)->create()->each(function ($image) {
            User::factory()
                ->create(['image_id' => $image->id]);
        });
    }
}
