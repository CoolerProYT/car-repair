<?php

namespace App\Livewire\User;

use App\Models\EmergencyOrder;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Emergency;
use CoolerProYT\RazermsPHP\PaymentChannel;
use Resend;

class EmergencyCheckout extends Component
{
    public $id;

    public $location;
    public $latitude;
    public $longitude;
    public $emergency;

    public $payment_channel;
    public $payment_method;
    public $txn_channel;

    public $cc_pan;
    public $cc_cvv2;
    public $cc_month;
    public $cc_year;

    public function mount()
    {
        $this->emergency = Emergency::find($this->id);

        $rms = new PaymentChannel('60dbae06055b568d86dca2d630a73726','4e293e5562c0c17be25176cae985a34e',true);

        $this->payment_channel = json_decode($rms->channelStatus('SB_oceansixty6prod'));
    }

    public function checkout(){
        $rms = new PaymentChannel('60dbae06055b568d86dca2d630a73726','4e293e5562c0c17be25176cae985a34e',true);

        do{
            $ref = random_int(100000, 999999);
        }while(EmergencyOrder::where('order_id',$ref)->exists());

        $this->validate([
            'payment_method' => 'required',
        ]);

        if($this->payment_method == 'Card'){
            $this->txn_channel = 'CREDIT7';

            $this->validate([
                'cc_pan' => 'required',
                'cc_cvv2' => 'required',
                'cc_month' => 'required',
                'cc_year' => 'required',
            ]);

            $response = $rms->createPayment([
                'MerchantID' => 'SB_oceansixty6prod',
                'ReferenceNo' => $ref,
                'TxnType' => 'SALS',
                'TxnChannel' => $this->txn_channel,
                'TxnCurrency' => 'MYR',
                'TxnAmount' => number_format($this->emergency->deposit, 2, '.', ''),
                'Signature' => md5(number_format($this->emergency->deposit, 2, '.', '').'SB_oceansixty6prod'.$ref.'4e293e5562c0c17be25176cae985a34e'),
                'CC_PAN' => '5555555555554444',
                'CC_CVV2' => '444',
                'CC_MONTH' => '12',
                'CC_YEAR' => '26',
                'ReturnURL' => route('user.emergency.handle'),
                'FailedURL' => route('user.emergency.handle'),
            ]);
        }
        /*else{
            $this->validate([
               'txn_channel' => 'required',
            ]);

            $response = $rms->createPayment([
                'MerchantID' => 'SB_oceansixty6prod',
                'ReferenceNo' => $ref,
                'TxnType' => 'SALS',
                'TxnChannel' => $this->txn_channel,
                'TxnCurrency' => 'MYR',
                'TxnAmount' => number_format($this->emergency->deposit, 2, '.', ''),
                'Signature' => md5(number_format($this->emergency->deposit, 2, '.', '').'SB_oceansixty6prod'.$ref.'4e293e5562c0c17be25176cae985a34e'),
                'ReturnURL' => route('user.emergency.handle'),
                'FailedURL' => route('user.emergency.handle'),
            ]);
        }*/

        EmergencyOrder::create([
            'seller_id' => $this->emergency->seller_id,
            'user_id' => Auth::guard('user')->user()->id,
            'emergency_id' => $this->emergency->id,
            'order_id' => $ref,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'total_payment' => $this->emergency->deposit,
        ]);

        $seller_id = $this->emergency->seller_id;
        $seller = Seller::find($seller_id);
        $seller_email = $seller->email;

        $resend = Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => 'new emergency order <noreply@jinitaimei.cloud>',
            'to' => [$seller_email],
            'subject' => 'New Emergency Order',
            'text' => 'You have a new emergency order. Please check your dashboard for more details.'
        ]);

        $response = json_decode($response);

        return redirect()->route('user.emergency.pay')->with('postData',$response->TxnData);
    }

    public function render()
    {
        return view('livewire.user.emergency-checkout');
    }
}
