<?php

namespace App\Livewire\Admin;

use App\Models\Seller;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Withdraw as WithdrawModel;
use Resend;
use Dompdf\Dompdf;

class Withdraw extends Component
{
    public $withdraws;

    public function mount(){
        $this->loadWithdraw();
    }

    public function loadWithdraw(){
        $this->withdraws = WithdrawModel::where('status', 'Pending')->get();
    }

    public function approve($id){
        $withdraw = WithdrawModel::find($id);

        $data = [
            'sellerName' => $withdraw->seller->username,
            'sellerId' => $withdraw->seller->id,
            'withdrawals' => [
                [
                    'amount' => $withdraw->amount,
                    'date' => $withdraw->created_at,
                    'status' => 'Approved',
                    'method' => 'Bank Transfer',
                ]
            ]
        ];

        $html = view('pdf.statement', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'withdrawal_' . $withdraw->id . '.pdf';
        $path = 'public/pdf/' . $filename;

        Storage::put($path, $dompdf->output());

        $withdraw->pdf = $filename;
        $withdraw->status = 'Approved';
        $withdraw->save();

        $seller_id = $withdraw->seller_id;
        $seller = Seller::find($seller_id);

        $resend = Resend::client(env('resend_api_key'));

        $resend->emails->send([
            'from' => 'noreply <noreply@' . env('RESEND_DOMAIN') . '>',
            'to' => [$seller->email],
            'subject' => 'Your withdraw request has been approved',
            'text' => "Your withdraw request has been approved. Please check your account for the money. Thank you."
        ]);

        $this->loadWithdraw();
    }

    public function render()
    {
        return view('livewire.admin.withdraw');
    }
}
