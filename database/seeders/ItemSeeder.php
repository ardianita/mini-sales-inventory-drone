<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Extra Baterry',
                'stock' => '100',
                'price' => '50000',
            ],
            [
                'name' => 'Charger Baterry',
                'stock' => '100',
                'price' => '60000',
            ],
            [
                'name' => 'Landing Pad',
                'stock' => '100',
                'price' => '50000',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
