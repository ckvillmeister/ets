<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       	$categories = [	
       					['Executive Order', 1, NULL, NULL],
    					['Memorandum Order', 1, NULL, NULL],
    					['Office Order', 1, NULL, NULL],
    					['Resolution', 1, NULL, NULL],
    					['Incoming Communication Letter', NULL, 1, 1],
    					['Outgoing Communication Letter', NULL, 1, 1]
    				];

    	foreach ($categories as $key => $category) {
    		Category::create([
					'category' => $category[0],
					'is_with_series_no' => $category[1],
			        'is_with_sender' => $category[2],
			        'is_with_receiver' => $category[3],
					'created_by' => 1,
					'created_at' => date('Y-m-d H:i:s')
					]);
    	}
    }
}
