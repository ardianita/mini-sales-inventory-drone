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
                'name' => 'Baterry',
                'stock' => '100',
            ],
            [
                'name' => 'Charger Baterry',
                'stock' => '100',
            ],
            [
                'name' => 'Landing Pad',
                'stock' => '100',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
