<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nums = range(1, 10);

        foreach ($nums as $num) {
            Todo::create([
                'title' => 'Todo ' . $num,
                'completed' => false,
                'user_id' => rand(1, 10),
                'sort_id' => $num,
            ]);
        }
    }
}
