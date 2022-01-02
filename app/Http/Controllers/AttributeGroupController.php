<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeGroupRequest;
use App\Http\Resources\AttributeGroupResource;
use App\Models\AttributeGroup;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->dashboard) {
            return AttributeGroupResource::collection(AttributeGroup::paginate(20));
        }
        return AttributeGroupResource::collection(AttributeGroup::where('is_active', 1)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeGroupRequest $request)
    {
        $attributeGroup = AttributeGroup::create($request->all());
        return new AttributeGroupResource($attributeGroup);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
        return new AttributeGroupResource($attributeGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeGroup $attributeGroup)
    {
        $attributeGroup->update($request->all());
        return new AttributeGroupResource($attributeGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->delete();
    }
}
