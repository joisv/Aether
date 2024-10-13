<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissionNames = ['edit', 'create', 'delete', 'update'];
        foreach ($permissionNames as $key => $name) {
           Permission::create(['name' => $name]);
        }
       Role::create(['name' => 'admin'])->givePermissionTo(['edit', 'create', 'update', 'delete']);

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole('admin');

        Category::factory()->count(10)->create();
        Product::factory()->count(50)->create();
    }
}
