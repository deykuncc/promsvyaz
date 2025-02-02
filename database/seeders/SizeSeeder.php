<?php

namespace Database\Seeders;


use App\Models\Size;

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $shoesSize = [];

        for ($x = 33; $x <= 48; $x++) {
            $shoesSize[] = ['type' => 'shoes', 'size' => $x];
        }

        Size::query()->insert(
            array_merge(
                [['type' => 'clothes', 'size' => '38 (XXS)'],
                    ['type' => 'clothes', 'size' => '40 (XS)'],
                    ['type' => 'clothes', 'size' => '42 (S)'],
                    ['type' => 'clothes', 'size' => '44-46 (M)'],
                    ['type' => 'clothes', 'size' => '48-50 (L)'],
                    ['type' => 'clothes', 'size' => '52 (XL)'],
                    ['type' => 'clothes', 'size' => '54-56 (XXL)'],
                    ['type' => 'clothes', 'size' => '58 (3XL)'],
                    ['type' => 'hats', 'size' => '54 (XXS)'],
                    ['type' => 'hats', 'size' => '55 (XS)'],
                    ['type' => 'hats', 'size' => '56 (S)'],
                    ['type' => 'hats', 'size' => '57 (M)'],
                    ['type' => 'hats', 'size' => '58 (L)'],
                    ['type' => 'hats', 'size' => '59 (XL)'],
                    ['type' => 'hats', 'size' => '60 (XXL)'],
                    ['type' => 'hats', 'size' => '61 (XXL)'],
                    ['type' => 'hats', 'size' => '62 (3XL)']],
                $shoesSize),
        );
    }
}
