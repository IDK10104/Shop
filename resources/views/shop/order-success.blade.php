@extends('layouts.app')
@section('title', 'Order Confirmed')

@section('content')
<div class="max-w-lg mx-auto px-4 sm:px-6 py-20 text-center">
    <div class="glass rounded-3xl p-10">
        <div class="w-20 h-20 rounded-full bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center mx-auto mb-6">
            <span class="text-4xl">✓</span>
        </div>
        <h1 class="text-2xl font-bold text-white mb-2">Order confirmed!</h1>
        <p class="text-zinc-400 text-sm mb-6">Thank you for your purchase. You'll receive a confirmation email shortly.</p>

        @if($order)
        <div class="bg-white/5 rounded-xl p-4 mb-6 text-left space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-zinc-500">Order #</span>
                <span class="text-white font-mono">{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-zinc-500">Customer</span>
                <span class="text-white">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-zinc-500">Total</span>
                <span class="text-white font-bold">{{ $order->total_formatted }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-zinc-500">Status</span>
                <span class="text-emerald-400 font-medium capitalize">{{ $order->status }}</span>
            </div>
        </div>
        @endif

        <a href="{{ route('home') }}" class="inline-flex px-6 py-3 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 text-white font-semibold text-sm hover:opacity-90 transition-opacity">
            Continue shopping →
        </a>
    </div>
</div>
@endsection
