<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergieëns')->insert([
            'naam' => 'melk',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'vis',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'ei',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'tarwe/gluten',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'chocola',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'honing',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'kip',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'pinda',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'wortel',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'aardbei',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'champignons',
            'icon' => str_random(10).'@gmail.com',
        ]);
        DB::table('allergieëns')->insert([
            'naam' => 'citrus',
            'icon' => str_random(10).'@gmail.com',
        ]);
    }
}
