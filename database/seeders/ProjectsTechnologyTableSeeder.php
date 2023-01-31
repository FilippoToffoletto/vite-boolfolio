<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 200; $i++){

            //estraggo random un progetto
            $project= Project::inRandomOrder()->first();

            //estraggo un ID random dai tag
            $technology_id = Technology::inRandomOrder()->first()->id;

            //inserisco il dato nella tabella ponte
            //con attach viene inserita la relazione nrlla tabella ponte
            //al metodo attach posso passare un singolo ID o un array di un ID

            // errore
            $project->technologies()->attach($technology_id);
        }
    }
}
