<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ecoms = ['PJK', 'Jasmine', 'Loyal'];
        foreach ($ecoms as $ecom) {
            Merchant::create([
                'nama' => $ecom
            ]);
        }
    }
}
