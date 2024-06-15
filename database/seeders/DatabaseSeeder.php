<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->create([
            'name' => 'Builder Admin',
            'username' => 'buildererp',
            'phone' => '1234567890',
            'email' => 'admin@buildererp.net',
            'password' => bcrypt('Builder@123456'),
        ]);

        $tenant = Tenant::create(['id' => Str::slug($user->name)]);
        $tenant->domains()->create(['domain' => $user->username . '.localhost']);
        $tenant->domains->first()->fqdn;
    }
}
