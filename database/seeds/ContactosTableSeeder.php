<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\Contacto;
class ContactosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contacto::create([
        	'Personal_mail' 	  => 'smlghost10@gmail.com',
        	'Personal_phone' 	  => null,
        	'Business_mail' 	  => 'Samuel.Lechuga@grupointerconsult.com',
            'Business_phone'       => null,
            'Landline'        => null,
            'Extension'  => '1222',
            'Family' => 'Edith',
            'Relationship' => 'Tio (a)',
            'Emergency_phone' => '1234567890',
            'Employee_id' => '1'
        ]);
    }
}
