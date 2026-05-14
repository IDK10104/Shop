<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products',
            'badge' => 'nullable|string|max:20',
            'featured' => 'boolean',
            'active' => 'boolean',
            'image' => 'nullable|url',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(4);
        $data['price'] = (int) round($data['price'] * 100);
        $data['compare_price'] = isset($data['compare_price']) ? (int) round($data['compare_price'] * 100) : null;
        $data['featured'] = $request->boolean('featured');
        $data['active'] = $request->boolean('active', true);

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'badge' => 'nullable|string|max:20',
            'image' => 'nullable|url',
        ]);

        $data['price'] = (int) round($data['price'] * 100);
        $data['compare_price'] = isset($data['compare_price']) ? (int) round($data['compare_price'] * 100) : null;
        $data['featured'] = $request->boolean('featured');
        $data['active'] = $request->boolean('active', true);

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }
}
