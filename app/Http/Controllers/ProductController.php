<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Resource_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('shop:id,name,slug', 'category:id,name,slug')->where('status', Product::STATUS_PUBLISHED);
        if ($request->shop_slug) {
            $products->whereHas('shop', function($q) use ($request) {
                $q->where('slug', $request->shop_slug);
            });
        }
        return ProductResource::collection($products->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all() + [
            'status'  => Product::STATUS_NEW,
            'user_id' => auth()->user()->id
        ]);

        $attributeValues = [];

        foreach ($request->attributeValues as $attribute) {
            $attributeValues[$attribute["attribute_id"]] = [
                'product_id' => $product->id,
                'price' => $attribute["price"],
                'value' => $attribute["value"],
            ];
        }

        $product->attribute_values()->sync($attributeValues);

        return new ProductResource($product->load('category:id,name,slug', 'shop:id,name,slug'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load('shop:id,name,slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function getProductsById(Request $request)
    {
        if ($request->products) {
            $products = Product::with('shop:id,name,slug', 'category:id,name,slug')->where('status', Product::STATUS_PUBLISHED)->whereIn('id', $request->products)->get();
            return ProductResource::collection($products);
        }
        abort(404);
    }

    public function getProductsWithShop(Shop $shop)
    {
        $products = Product::with("category:id,name,slug")->where(['shop_id' => $shop->id])->paginate(12);
        return ProductResource::collection($products);
    }
}
