<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Emergency;

class EmergencyController extends Controller
{
    public function emergency(){
        return view('seller.emergency');
    }

    public function addEmergency(){
        return view('seller.add_emergency');
    }

    public function editEmergency($id){
        $emergency = Emergency::where([
            'id' => $id,
            'seller_id' => auth()->guard('seller')->user()->id
        ])->exists();

        if(!$emergency) return redirect()->route('seller.emergency');

        return view('seller.edit_emergency',['id' => $id]);
    }
}
