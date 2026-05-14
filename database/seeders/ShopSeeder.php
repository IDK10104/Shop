<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Home & Living', 'slug' => 'home-living'],
            ['name' => 'Sports', 'slug' => 'sports'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $home = Category::where('slug', 'home-living')->first();
        $sports = Category::where('slug', 'sports')->first();

        $products = [
            [
                'name' => 'AirPods Pro 2',
                'category_id' => $electronics->id,
                'short_description' => 'Active noise cancellation, adaptive transparency',
                'description' => 'The AirPods Pro 2 deliver incredible sound quality with industry-leading active noise cancellation. Featuring adaptive transparency mode, a personalized spatial audio experience, and up to 30 hours of total listening time with the case.',
                'price' => 24900,
                'compare_price' => 29900,
                'stock' => 50,
                'featured' => true,
                'badge' => 'Sale',
                'image' => 'https://images.unsplash.com/photo-1588156979435-379b9d802b0a?w=600&q=80',
            ],
            [
                'name' => 'MacBook Pro 14"',
                'category_id' => $electronics->id,
                'short_description' => 'M3 chip, 18-hour battery, Liquid Retina XDR',
                'description' => 'The most powerful MacBook Pro ever with the M3 chip. Features a stunning Liquid Retina XDR display, up to 18 hours of battery life, and incredible performance for professionals.',
                'price' => 199900,
                'stock' => 20,
                'featured' => true,
                'badge' => 'New',
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=600&q=80',
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'category_id' => $electronics->id,
                'short_description' => 'Industry-leading noise canceling headphones',
                'description' => 'Experience the next level of silence with the WH-1000XM5 headphones. Features industry-leading noise canceling, 30-hour battery life, and crystal clear hands-free calling.',
                'price' => 34900,
                'compare_price' => 39900,
                'stock' => 35,
                'featured' => true,
                'badge' => 'Hot',
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&q=80',
            ],
            [
                'name' => 'iPhone 15 Pro',
                'category_id' => $electronics->id,
                'short_description' => 'Titanium design, A17 Pro chip, 48MP camera',
                'description' => 'iPhone 15 Pro. Forged in titanium and featuring the groundbreaking A17 Pro chip, a customizable Action button, and the most powerful iPhone camera system ever.',
                'price' => 99900,
                'stock' => 40,
                'featured' => false,
                'badge' => 'New',
                'image' => 'https://images.unsplash.com/photo-1696446701796-da61225697cc?w=600&q=80',
            ],
            [
                'name' => 'Premium Hoodie',
                'category_id' => $clothing->id,
                'short_description' => 'Heavyweight 400gsm cotton blend',
                'description' => 'Crafted from premium heavyweight cotton blend, this hoodie offers exceptional warmth and durability. Features a relaxed fit, kangaroo pocket, and ribbed cuffs.',
                'price' => 7900,
                'compare_price' => 9900,
                'stock' => 100,
                'featured' => true,
                'badge' => 'Sale',
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f15732ce?w=600&q=80',
            ],
            [
                'name' => 'Minimalist Sneakers',
                'category_id' => $clothing->id,
                'short_description' => 'Clean design, all-day comfort',
                'description' => 'Timeless minimalist sneakers designed for everyday wear. Features a clean silhouette, premium leather upper, and cushioned sole for all-day comfort.',
                'price' => 12900,
                'stock' => 60,
                'featured' => true,
                'badge' => null,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80',
            ],
            [
                'name' => 'Ceramic Desk Lamp',
                'category_id' => $home->id,
                'short_description' => 'Handcrafted ceramic base, warm LED',
                'description' => 'A beautifully handcrafted ceramic desk lamp that adds warmth and elegance to any space. Features a dimmable warm LED bulb and minimalist design.',
                'price' => 8900,
                'stock' => 30,
                'featured' => false,
                'badge' => 'New',
                'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=600&q=80',
            ],
            [
                'name' => 'Yoga Mat Pro',
                'category_id' => $sports->id,
                'short_description' => '6mm thickness, non-slip, eco-friendly',
                'description' => 'Professional grade yoga mat made from eco-friendly natural rubber. Features superior grip, 6mm cushioning, and alignment lines for perfect pose positioning.',
                'price' => 6900,
                'compare_price' => 8900,
                'stock' => 80,
                'featured' => true,
                'badge' => 'Sale',
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=600&q=80',
            ],
        ];

        foreach ($products as $p) {
            $slug = Str::slug($p['name']) . '-' . Str::random(4);
            Product::firstOrCreate(
                ['name' => $p['name']],
                array_merge($p, ['slug' => $slug, 'active' => true])
            );
        }
    }
}
