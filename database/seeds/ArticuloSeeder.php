<?php

use Illuminate\Database\Seeder;
use App\Models\Articulo;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articulo::create([
            'register_number'=>'0010k',
            'name'=>'Toma-corriente',
            'quantity'=>15,
            'categoria_id'=> 1
        ]);
    }
}
