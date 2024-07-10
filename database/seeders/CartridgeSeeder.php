<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cartridges')->insert([
            'id'          => 001,
            'printer_id'  => 001,
            'model'       => '(Ninguno)',
            'image'       => NULL,
            'description' => '(Ninguno)',
            'color'       => '(Ninguno)',
            'status'      => 'Active',
        ]);
    }
}
