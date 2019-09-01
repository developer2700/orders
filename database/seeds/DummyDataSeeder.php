<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Total number of users.
     *
     * @var int
     */
    protected $totalUsers = 25;

    /**
     * Total number of orders.
     *
     * @var int
     */
    protected $totalOrders = 10;

    /**
     * Total number of products.
     *
     * @var int
     */
    protected $totalProducts = 18;


    /**
     * Populate the database with dummy data for testing.
     * Complete dummy data generation including relationships.
     * Set the property values as required before running database seeder.
     *
     * @param \Faker\Generator $faker
     */
    public function run(\Faker\Generator $faker)
    {
        $users = factory(\App\Models\User::class)->times($this->totalUsers)->create();

        $products = factory(\App\Models\Product::class)->times($this->totalProducts)->create();

        $users->each(function ($user) use ($faker, $products) {
            $products->random($faker->numberBetween(1, (int)$products->count()))
                ->each(function ($product) use ($user) {
                    $randomDay = rand(1, 9);
                    $date = date('Y-m-d H:i:s', strtotime("-$randomDay days"));
                    $user->orders()->create([
                        'product_id' => $product->id,
                        'quantity' => rand(1, 9),
                        'price' => $product->price,
                        'created_at' => $date,
                    ]);
                });

        });

    }
}
