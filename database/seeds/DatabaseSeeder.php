<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();
    	Product::truncate();
    	Store::truncate();

        DB::table('users')->insert([
        	'name' => 'Admin',
            'username' => 'root',
            'password' => bcrypt('123456'),
            'reset_password' => RESET_PASS,
            'is_root' => ROOT,
        ]);

		factory(User::class, 3)->create()->each(function ($user) {
		    factory(Store::class, 4)->create(['user_id'=>$user->id]);
		});

		factory(Product::class, 10)->create();

		$products = Product::all();

		Store::all()->each(function ($store) use ($products) { 
    	$store->products()->attach($products->random(rand(1, 10))->pluck('id')->toArray(), ['count' => rand(1,50)]); 
		});

    }
}
