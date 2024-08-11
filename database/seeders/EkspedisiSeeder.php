<?php

namespace Database\Seeders;

use App\Models\Ekspedisi;
use Illuminate\Database\Seeder;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ekspedisis = ['JNT', 'JNE', 'JTR', 'SPX'];
        foreach ($ekspedisis as $ekspedisi) {
            Ekspedisi::create(['nama' => $ekspedisi]);
        }
    }
}
