<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\ProductAttribute;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\Pure;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $attr = ProductAttribute::query()->paginate(20);
        return AttributeResource::collection($attr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttributeRequest $request
     * @return AttributeResource
     */
    public function store(AttributeRequest $request): AttributeResource
    {
        $attr = ProductAttribute::create($request->all());
        return new AttributeResource($attr);
    }

    /**
     * Display the specified resource.
     *
     * @param ProductAttribute $attribute
     * @return AttributeResource
     */
    #[Pure] public function show(ProductAttribute $attribute): AttributeResource
    {
        return new AttributeResource($attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttributeRequest $request
     * @param ProductAttribute $attribute
     * @return AttributeResource
     */
    public function update(AttributeRequest $request, ProductAttribute $attribute): AttributeResource
    {
        $attribute->update($request->all());
        return new AttributeResource($attribute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductAttribute $attribute
     * @return void
     */
    public function destroy(ProductAttribute $attribute): void
    {
        $attribute->delete();
    }
}
