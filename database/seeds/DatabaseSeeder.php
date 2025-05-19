<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        //$this->call(PaisTableSeeder::class);
        //$this->call(DepartamentosTableSeeder::class);
        //$this->call(JerarquiasTableSeeder::class);
        //$this->call(TipodeempleadosTableSeeder::class);
        //$this->call(EscolaridadTableSeeder::class);
        //$this->call(VoucherTableSeeder::class);
        //$this->call(TipodecontratosTableSeeder::class);
        //$this->call(EmpresasTableSeeder::class);
        //$this->call(PuestoTableSeeder::class);
        //$this->call(EmpleadoTableSeeder::class);
        //$this->call(DatosTableSeeder::class);
        //$this->call(DomiciliosTableSeeder::class);
        //$this->call(ContactosTableSeeder::class);
        //$this->call(ContratacionesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
