<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrinterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('printers')->insert([
            'id'          => 001,
            'brand_id'    => 001,
            'serial'      => '(NINGUNO)',
            'model'       => '(NINGUNO)',
            'description' => '(NINGUNO)',
            'image'       => NULL,
            'location'    => '(NINGUNO)',
            'observation' => NULL,
            'status'      => 'Active',
        ]);
    }
}
