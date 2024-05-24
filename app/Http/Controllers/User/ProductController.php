<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Seller;
use CoolerProYT\RazermsPHP\PaymentChannel;
use Illuminate\Http\Request;
use Resend;

class ProductController extends Controller
{
    public function product($category, Request $request){
        $search = $request->query('search') ?? '';
        return view('user.product', ['category' => $category, 'search' => $search]);
    }

    public function productDetail($id){
        if(!Product::where('id',$id)->exists()){
            return redirect()->route('user.home');
        }
        return view('user.product_detail',['id'=>$id]);
    }

    public function productCheckout($id,Request $request){
        if(!Product::where('id',$id)->exists()){
            return redirect()->route('user.home');
        }
        $quantity = $request->query('quantity') ?? 1;
        return view('user.product_checkout',['id'=>$id,'quantity'=>$quantity]);
    }

    public function productPay(Request $request){
        $rms = new PaymentChannel(env('RMS_S_KEY'),env('RMS_V_KEY'),true);

        $rms->redirectToPaymentPage($request->session()->get('postData'));
    }

    public function productHandle(Request $request){
        $tranID = $request->query('tranID');
        $status = $request->query('status'); // 00 = success, 11 = failed
        $amount = $request->query('amount');
        $paydate = $request->query('paydate');
        $orderid = $request->query('orderid');

        if($status == '00'){
            $order = ProductOrder::where('order_id',$orderid)->first();
            $order->tran_id = $tranID;
            $order->save();

            $seller_id = Product::where('id',$order->product_id)->first()->seller_id;
            $seller = Seller::find($seller_id);
            $seller->balance += $amount;
            $seller->save();

            $resend = Resend::client(env('RESEND_API_KEY'));

            $resend->emails->send([
                'from' => 'new product order <noreply@jinitaimei.cloud>',
                'to' => [$seller->email],
                'subject' => 'New Product Order',
                'text' => 'You have a new product order. Please check your dashboard for more details.'
            ]);
        }
        else if($status == '11'){
            ProductOrder::where('order_id',$orderid)->delete();
        }

        return redirect()->route('user.order');
    }
}
