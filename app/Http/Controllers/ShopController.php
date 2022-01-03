<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->dashboard) {
            return ShopResource::collection(Shop::with('author:id,name', 'category:id,name,is_active')->paginate(20));
        }
        $shops = Shop::with('category:id,name')->where('status', Shop::STATUS_PUBLISHE);

        if($request->category_slug) {
            $shops->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category_slug);
            });
        }

        if($request->q) {
            $shops->where('name', 'like', "%$request->q%")->whereOr('description', 'like', "%$request->q%");
        }

        return ShopResource::collection($shops->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        if ($request->dashboard) {
            $shop = Shop::create($request->all());
        } else {
            $shop = Shop::create($request->all() + [
                'status'  => Shop::STATUS_NEW,
                'user_id' => auth()->user()->id
            ]);
        }

        return new ShopResource($shop->load('category:id,name,slug'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return new ShopResource($shop->load('category:id,name,slug', 'author:id,name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        if ($request->dashboard) {
            $shop->update($request->all());
        } else {
            $shop->update($request->all() + [
                'status'  => Shop::STATUS_IN_MODERATION
            ]);
        }

        return new ShopResource($shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        if($shop->user_id === auth()->user()->id) {
            Product::where('shop_id', $shop->id)->delete();
            $shop->delete();
            return response()->json([
                'message' => 'Магазин с продуктами успешно удалено'
            ]);
        }
        else if($request->dashboard) {
            Product::where('shop_id', $shop->id)->delete();
            $shop->delete();
            return response()->json([
                'message' => 'Магазин с продуктами успешно удалено'
            ]);
        }

        abort(404);
    }

    public function getUserShops() {
        $shops = Shop::where('user_id', auth()->user()->id)->get();
        return ShopResource::collection($shops);
    }
}
