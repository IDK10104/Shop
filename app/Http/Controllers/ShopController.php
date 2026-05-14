<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $featured = Product::active()->featured()->with('category')->take(8)->get();
        $categories = Category::withCount('products')->get();
        $newArrivals = Product::active()->latest()->take(4)->get();
        return view('shop.home', compact('featured', 'categories', 'newArrivals'));
    }

    public function catalog(Request $request)
    {
        $query = Product::active()->with('category');

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }
        if ($request->sort === 'price_asc') $query->orderBy('price');
        elseif ($request->sort === 'price_desc') $query->orderByDesc('price');
        else $query->latest();

        $products = $query->paginate(12);
        $categories = Category::all();
        return view('shop.catalog', compact('products', 'categories'));
    }

    public function product(Product $product)
    {
        abort_unless($product->active, 404);
        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();
        return view('shop.product', compact('product', 'related'));
    }
}
