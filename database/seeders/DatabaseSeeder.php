<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Database\Seeders\Permissions\CrudPermissionSeeder;
use Database\Seeders\Permissions\PermissionSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(self::seeders());
        $categories = Category::factory(10)->create();
        foreach ($categories as $category) {
            Event::factory(random_int(1, 3))->create(['category_id' => $category->id]);
        }
    }

    public static function seeders()
    {
        $seeders = [
            PermissionSeeder::class,
            CrudPermissionSeeder::class,
            UserSeeder::class,
        ];
        if (! App::environment('prod') && ! App::environment('preprod')) {
            $seeders = array_merge($seeders, []);
        }

        return $seeders;
    }
}
