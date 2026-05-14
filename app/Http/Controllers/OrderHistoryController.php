<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_email', Auth::user()->email)
            ->with('items')
            ->latest()
            ->get();

        return view('account.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->customer_email === Auth::user()->email, 403);
        $order->load('items.product');
        return view('account.order-detail', compact('order'));
    }
}
