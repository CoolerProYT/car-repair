<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Emergency;
use App\Models\EmergencyOrder;
use App\Models\Seller;
use CoolerProYT\RazermsPHP\PaymentChannel;
use Illuminate\Http\Request;
use Resend;

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
        $rms = new PaymentChannel(env('RMS_S_KEY'),env('RMS_V_KEY'),true);

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
            $order->status = 'Pending';
            $order->save();

            $seller_id = Emergency::where('id',$order->emergency_id)->first()->seller_id;
            $seller = Seller::find($seller_id);
            $seller->balance += $amount;
            $seller->save();

            $resend = Resend::client(env('RESEND_API_KEY'));

            $resend->emails->send([
                'from' => 'new emergency order <noreply@' . env('RESEND_DOMAIN') . '>',
                'to' => [$seller->email],
                'subject' => 'New Emergency Order',
                'text' => 'You have a new emergency order. Please check your dashboard for more details.'
            ]);
        }
        else if($status == '11'){
            EmergencyOrder::where('order_id',$orderid)->delete();
        }

        return redirect()->route('user.order');
    }
}
