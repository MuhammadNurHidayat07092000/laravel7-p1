<?php

use Illuminate\Database\Seeder;

class EdulevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edulevel2')->insert([
            [
                'name' => 'SD 1 KOBI',
                'desc' => 'SD yang ada',
            ],

            [
                'name' => 'SD 5 KOBI',
                'desc' => 'SD yang ada di Kobi Juga',
            ]

        ]);
    }
}
