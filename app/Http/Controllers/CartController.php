<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function sessionId(): string
    {
        return session()->getId();
    }

    public function index()
    {
        $items = CartItem::where('session_id', $this->sessionId())
            ->with('product')
            ->get();
        $total = $items->sum('line_total');
        return view('shop.cart', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->quantity ?? 1);

        $item = CartItem::where('session_id', $this->sessionId())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->increment('quantity', $qty);
        } else {
            CartItem::create([
                'session_id' => $this->sessionId(),
                'product_id' => $product->id,
                'quantity' => $qty,
            ]);
        }

        return back()->with('success', "{$product->name} added to cart!");
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($request->quantity < 1) {
            $cartItem->delete();
        } else {
            $cartItem->update(['quantity' => $request->quantity]);
        }
        return back();
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('success', 'Item removed.');
    }

    public function count(): int
    {
        return CartItem::where('session_id', $this->sessionId())->sum('quantity');
    }
}
