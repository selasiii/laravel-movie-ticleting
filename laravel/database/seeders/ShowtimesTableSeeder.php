<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use Carbon\Carbon;

class ShowtimesTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch all movie IDs
        $movies = Movie::all();
        
        $rooms = ['A1', 'A2', 'B1', 'B2', 'C1'];  // Sample room names

        foreach ($movies as $movie) {
            foreach (range(1, 3) as $dayOffset) {  // For the next 7 days
                $numberOfShowtimes = rand(1, 3);  // Random number of showtimes between 1 to 5

                for ($i = 0; $i < $numberOfShowtimes; $i++) {
                    $startTime = Carbon::now()->addDays($dayOffset)->setHour(rand(10, 20))->setMinute(0);  // Random hour between 10am to 8pm
                    $endTime = (clone $startTime)->addMinutes($movie->duration);  // Use movie duration directly


                    DB::table('showtimes')->insert([
                        'movie_id' => $movie->id,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'price' => rand(50, 200),  // Random price between 50 to 200
                        'room' => $rooms[array_rand($rooms)],
                        'limit' => 50,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
