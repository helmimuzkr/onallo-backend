<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Kavist\RajaOngkir\Facades\RajaOngkir;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\City;

class LocationController extends Controller
{
    public function provinces() {
        return Province::all();
    }

    public function regencies($provinces_id) {
        return Regency::where('province_id', $provinces_id)->get();
    }

    public function districts($regencies_id) {
        return District::where('regency_id', $regencies_id)->get();
    }

    public function city($province_id)
    {
        return City::where('province_id', $province_id)->get();
    }

    public function city_id($city_id)
    {
        return City::find($city_id);
    }

    public function checkOngkir(Request $request)
    {
        $cost =  RajaOngkir::ongkosKirim([
            'origin' => 67, //ID kota / Kabupaten asal/ 113 adalah kode kota Bekasi
            'destination' => $request->city_destination, //Id Kota //kabupaten tujuan
            'weight' => 100, // berat barang dalam gram sample 100
            'courier' => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cost All Courir: ' . $request->courier,
            'data'    => $cost
        ]);
    }
}
