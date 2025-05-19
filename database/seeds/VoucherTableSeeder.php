<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Voucher;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::create([
        	'Voucher' 		=> 'Titulo',
        	'Slug' 			=> 'titulo'
        ]);

        Voucher::create([
            'Voucher'       => 'Comprobante de estudios',
            'Slug'          => 'comprobante_de_estudios'
        ]);
    }
}
