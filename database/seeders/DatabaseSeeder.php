<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ContentStructureSeeder::class);
        $this->call(AboutStorySeeder::class);
        $this->call(CeoPageSeeder::class);
        $this->call(DoctorContentSeeder::class);
        $this->call(WhyChooseUsSeeder::class);
        $this->call(CataractContentSeeder::class);
        $this->call(EyeDiseaseContentSeeder::class);
        $this->call(ChildrenContentSeeder::class);
        $this->call(HomeContentAssetsSeeder::class);
    }
}
