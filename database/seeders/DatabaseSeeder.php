<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            UnitKerjaSeeder::class,
            CategoriesTableSeeder::class,
            ItemLocationsTableSeeder::class,
            ItemBrandsTableSeeder::class,
            StatusesTableSeeder::class,
            ItemDetailsTableSeeder::class,
            RackTypeSeeder::class,
            RackAttributeSeeder::class,
            RackStatusSeeder::class,
            TypeDeviceSeeder::class,
        ]);
    }
}
