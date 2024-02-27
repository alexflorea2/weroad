<?php

namespace App\Console\Commands;

use App\Models\Mood;
use App\Models\Role;
use App\Models\Tour;
use App\Models\Travel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeedFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-from-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds the database from JSON files.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::transaction(function () {
            $this->seedRoles();
            $this->seedUsers();
            $this->seedTravels();
            $this->seedTours();
        });

        $this->info('Database seeded successfully from JSON files.');
    }

    protected function seedRoles()
    {
        $jsonPath = database_path('data/roles.json');
        $roles = json_decode(file_get_contents($jsonPath), true);

        foreach ($roles as $roleData) {
            $role = new Role();
            $role->id = $roleData['id'];
            $role->name = $roleData['name'];
            $role->save();
        }

        $this->info('Roles seeded!');
    }

    protected function seedUsers()
    {
        $jsonPath = database_path('data/users.json');
        $users = json_decode(file_get_contents($jsonPath), true);

        foreach ($users as $userData) {
            $user = new User();
            $user->id = $userData['id'];
            $user->name = $userData['name'];
            $user->email = $userData['email'];
            $user->roleId = $userData['roleId'];
            $user->password = Hash::make($userData['password']);
            $user->email_verified_at = new \DateTime();
            $user->save();
        }

        $this->info('Roles seeded!');
    }

    protected function seedTravels()
    {
        $jsonPath = database_path('data/travels.json');
        $travels = json_decode(file_get_contents($jsonPath), true);

        foreach ($travels as $travelData) {
            $travel = new Travel();
            $travel->id = $travelData['id'];
            $travel->slug = $travelData['slug'];
            $travel->name = $travelData['name'];
            $travel->description = $travelData['description'];
            $travel->numberOfDays = $travelData['numberOfDays'];
            $travel->isPublic = true;
            $travel->save();

            // Handle moods
            foreach ($travelData['moods'] as $moodName => $weight) {
                $mood = Mood::where(['name' => $moodName])->first();
                if (! $mood) {
                    $mood = new Mood();
                    $mood->name = $moodName;
                    $mood->save();
                }
                $travel->moods()->syncWithoutDetaching([(string) $mood->id => ['weight' => $weight]]);
            }
        }

        $this->info('Travels and associated moods seeded!');
    }

    protected function seedTours()
    {
        $jsonPath = database_path('data/tours.json');
        $tours = json_decode(file_get_contents($jsonPath), true);

        foreach ($tours as $tourData) {
            $tour = new Tour();
            $tour->id = $tourData['id'];
            $tour->travelId = $tourData['travelId'];
            $tour->name = $tourData['name'];
            $tour->startingDate = Carbon::createFromFormat('Y-m-d', $tourData['startingDate']);
            $tour->endingDate = Carbon::createFromFormat('Y-m-d', $tourData['endingDate']);
            $tour->price = $tourData['price'] / 100;
            $tour->save();
        }

        $this->info('Tours seeded!');
    }
}
