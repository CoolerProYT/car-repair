<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\EmergencyOrder;
use App\Models\ProductOrder;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $e_pending;
    public $e_otw;
    public $e_completed;

    public $p_pending;
    public $p_processing;
    public $p_completed;

    public $week_e_orders;
    public $week_p_orders;

    public function mount(){
        $this->e_pending = EmergencyOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'Pending')->count();
        $this->e_otw = EmergencyOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'On The Way')->count();
        $this->e_completed = EmergencyOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'Completed')->count();

        $this->p_pending = ProductOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'Pending')->count();
        $this->p_processing = ProductOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'Processing')->count();
        $this->p_completed = ProductOrder::where('seller_id', auth()->guard('seller')->user()->id)->where('status', 'Completed')->count();

        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $orders = EmergencyOrder::where('seller_id', auth()->guard('seller')->user()->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $dates = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $dates->put($date, 0);
        }

        $orders = $dates->merge($orders);
        $orders = $orders->reverse();

        $this->week_e_orders = $orders;

        $p_orders = ProductOrder::where('seller_id', auth()->guard('seller')->user()->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date');

        $dates = collect();
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $dates->put($date, 0);
        }

        $p_orders = $dates->merge($p_orders);
        $p_orders = $p_orders->reverse();

        $this->week_p_orders = $p_orders;
    }

    public function render()
    {
        return view('livewire.seller.dashboard');
    }
}
