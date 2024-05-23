<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Emergency;
use App\Models\EmergencyOrder;
use CoolerProYT\RazermsPHP\PaymentChannel;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function emergency($category){
        return view('user.emergency',['category'=>$category]);
    }
    public function emergencyDetail($id){
        if(!Emergency::where('id',$id)->exists()){
            return redirect()->route('user.home');
        }
        return view('user.emergency_detail',['id'=>$id]);
    }

    public function emergencyCheckout($id){
        if(!Emergency::where('id',$id)->exists()){
            return redirect()->route('user.home');
        }
        return view('user.emergency_checkout',['id'=>$id]);
    }

    public function emergencyPay(Request $request){
        $rms = new PaymentChannel('60dbae06055b568d86dca2d630a73726','4e293e5562c0c17be25176cae985a34e',true);

        $rms->redirectToPaymentPage($request->session()->get('postData'));
    }

    public function emergencyHandle(Request $request){
        $tranID = $request->query('tranID');
        $status = $request->query('status'); // 00 = success, 11 = failed
        $amount = $request->query('amount');
        $paydate = $request->query('paydate');
        $orderid = $request->query('orderid');

        if($status == '00'){
            $order = EmergencyOrder::where('order_id',$orderid)->first();
            $order->tran_id = $tranID;
            $order->save();
        }
        else if($status == '11'){
            EmergencyOrder::where('order_id',$orderid)->delete();
        }

        return redirect()->route('user.home'); // Should redirect to a page that shows the payment status
    }
}
