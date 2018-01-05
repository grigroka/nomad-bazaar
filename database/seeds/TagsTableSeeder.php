<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('tags')->get()->count() == 0){
            $tasks = [
                ['name' => 'PHP'],
                ['name' => 'Laravel'],
                ['name' => 'Rails'],
                ['name' => 'Ruby'],
                ['name' => 'Javascript'],
                ['name' => 'React'],
                ['name' => 'Swift'],
                ['name' => 'Python'],
                ['name' => 'Node js'],
                ['name' => 'Mongodb'],
                ['name' => 'Android'],
                ['name' => 'Java'],
                ['name' => 'Web'],
                ['name' => 'HTML'],
                ['name' => 'Game dev'],
                ['name' => 'Frontend'],
                ['name' => 'Backend'],
                ['name' => 'Full-stack'],
                ['name' => 'CSS']

            ];
            DB::table('tags')->insert($tasks);
        }
    }
}
