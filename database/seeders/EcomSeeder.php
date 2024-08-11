<?php

namespace Database\Seeders;

use App\Models\Ecom;
use Illuminate\Database\Seeder;

class EcomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ecoms = ['Shopee', 'Tokopedia', 'Tiktok'];
        foreach ($ecoms as $ecom) {
            Ecom::create([
                'nama' => $ecom
            ]);
        }
    }
}
