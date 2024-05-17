<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(RoleTableSeeder::class);
        $this->call(UserStateTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(ResidenceTableSeeder::class);
        $this->call(ReferenceLookupTableSeeder::class);
        $this->call(SpecialtyTableSeeder::class);
        $this->call(IndustryTableSeeder::class);
        $this->call(UserIconTableSeeder::class);
        $this->call(MentorStatusLookupSeeder::class);
        $this->call(MentorshipSessionStatusTableSeeder::class);
        $this->call(UniversityTableSeeder::class);
        $this->call(EducationLevelTableSeeder::class);
        $this->call(MenteeStatusLookupSeeder::class);
    }
}
