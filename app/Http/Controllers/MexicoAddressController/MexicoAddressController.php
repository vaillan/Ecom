<?php

namespace App\Http\Controllers\MexicoAddressController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mexico_address\Mexico_address as MexicoAddress;

class MexicoAddressController extends Controller
{
    public function getMexicoAddress() {
        $mexico_address = MexicoAddress::orderBy('id','asc')->get();
        return response()->json(['valid' => true, 'mexico' => $mexico_address],200);
    }
}
