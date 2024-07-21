<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Jim HALPER',
            'email' => 'jim@mifflin.com',
            'password' => bcrypt('password'),
        ]);

        //add some links to the test User
        DB::table('links')->insert([
            [
                'nom' => "Dunder Mifflin Lip Dub",
                'lien' => "https://www.youtube.com/watch?v=_Bi9SUW-4fg&pp=ygUWZHVuZGVyIG1pZmZsaW4gbGlwIGR1Yg%3D%3D",
                'place' => "1",
                'user_id' => "1",
            ],
            [
                'nom' => "Paper",
                'lien' => "https://media.licdn.com/dms/image/C4D1BAQE6ubqTVYbotg/company-background_10000/0/1583999476725/dunder_mifflin_scranton_cover?e=2147483647&v=beta&t=BhkjCFnv5vFKE07YbBZG4jivl2baWUsLR_Aiw_Q_URM",
                'place' => "2",
                'user_id' => "1",
            ],
            [
                'nom' => "Athlead",
                'lien' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTgu7PwE4WemOaPNv5yfhiBqA4UGkEgiJj6g&s",
                'place' => "3",
                'user_id' => "1",
            ]
        ]);

    }
}
