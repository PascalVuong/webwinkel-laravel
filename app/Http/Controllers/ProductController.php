<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::query()
            ->select(['id', 'category_id', 'name', 'slug', 'price'])
            ->with(['category:id,name,slug'])
            ->where('is_active', true)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('producten/index', [
            'products' => $products,
        ]);
    }

    public function show(Product $product): Response
    {
        abort_if(! $product->is_active, 404);

        $product->load(['category:id,name,slug']);

        return Inertia::render('producten/show', [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'description' => $product->description,
                'category' => $product->category
                    ? [
                        'id' => $product->category->id,
                        'name' => $product->category->name,
                        'slug' => $product->category->slug,
                    ]
                    : null,
            ],
        ]);
    }
}