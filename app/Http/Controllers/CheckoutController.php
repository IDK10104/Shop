<?php
namespace App\Http\Controllers;

use App\Mail\NewOrderAlert;
use App\Mail\OrderConfirmation;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = CartItem::where('session_id', session()->getId())
            ->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $total = $items->sum('line_total');
        return view('shop.checkout', compact('items', 'total'));
    }

    public function createSession(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
        ]);

        $cartItems = CartItem::where('session_id', session()->getId())
            ->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = $cartItems->map(fn($item) => [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $item->product->name],
                'unit_amount' => $item->product->price,
            ],
            'quantity' => $item->quantity,
        ])->toArray();

        $order = Order::create([
            'status' => 'pending',
            'subtotal' => $cartItems->sum('line_total'),
            'total' => $cartItems->sum('line_total'),
            'customer_name' => $request->name,
            'customer_email' => $request->email,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $request->email,
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}&order=' . $order->id,
            'cancel_url' => route('checkout'),
            'metadata' => ['order_id' => $order->id],
        ]);

        $order->update(['stripe_session_id' => $session->id]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $order = Order::with('items')->find($request->order);
        if ($order && $order->status === 'pending') {
            $order->update(['status' => 'paid']);
            CartItem::where('session_id', session()->getId())->delete();

            $order->load('items');

            // Send customer confirmation
            Mail::to($order->customer_email)
                ->send(new OrderConfirmation($order));

            // Send admin notification
            Mail::to('benedekrad@gmail.com')
                ->send(new NewOrderAlert($order));
        }
        return view('shop.order-success', compact('order'));
    }
}
