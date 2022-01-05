<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::with('shop:id,name,slug', 'category:id,name,slug', 'weight');
        return ProductResource::collection($products->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request): ProductResource
    {
        $product = Product::create($request->all());
        return new ProductResource($product->load('category:id,name,slug', 'shop:id,name,slug', 'weight'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product->load('shop:id,name, weight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product): void
    {
        //
    }

    /**
     * Display product with published status
     *
     * @param Request $request
     * @return AnonymousResourceCollection|void
     */
    public function getProductsById(Request $request)
    {
        if ($request->products) {
            $products = Product::with('shop:id,name,slug', 'category:id,name,slug, weight')
                ->whereIn('id', $request->products)->get();
            return ProductResource::collection($products);
        }
        abort(404);
    }

    /**
     * Display shop products
     *
     * @param Shop $shop
     * @return AnonymousResourceCollection
     */
    public function getProductsWithShop(Shop $shop): AnonymousResourceCollection
    {
        $products = Product::with("category:id,name,slug, weight")
            ->where(['shop_id' => $shop->id])
            ->paginate(12);
        return ProductResource::collection($products);
    }
}
