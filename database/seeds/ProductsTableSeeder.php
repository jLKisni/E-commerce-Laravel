<?php

use App\Product;
use Illuminate\Database\Seeder;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    
    {
    	for ($i = 1; $i <= 30; $i++) {

        Product::create([
        	'name' => 'Laptop ' . $i,
            'slug' => 'laptop-' . $i,
            'details' => [13, 14, 15][array_rand([13, 14, 15])] . ' inch, ' . [1, 2, 3][array_rand([1, 2, 3])] . ' TB SSD, 32GB RAM',
            'price' => rand(149999, 249999),
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic.'

        ]);

        }
    }
}
