<?php

use Illuminate\Database\Seeder;
use App\Province;
use App\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsi) {
            Province::create([
                'province_id' => $provinsi['province_id'],
                'title' => $provinsi['province']
            ]);
            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsi['province_id'])->get();
            foreach ($daftarKota as $kota) {
                City::create([
                    'province_id' => $provinsi['province_id'],
                    'city_id' => $kota['city_id'],
                    'title' => $kota['city_name']
                ]);
            }
        }
    }
}
