<?php

namespace App\Http\Controllers;

use App\Http\Requests\TariffRequest;
use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $builder = Tariff::query();
        $tariffs = [];
        if (is_null(Auth::user()) || Auth::user()->hasRole('user')){
            $tariffs = $builder->where('is_active', '=', true)->get();
        } elseif (!is_null(Auth::user()) && !Auth::user()->hasRole('user')) {
            $tariffs = $builder->get();
        }

        return TariffResource::collection($tariffs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TariffRequest $request
     * @return Response|TariffResource
     */
    public function store(TariffRequest $request): Response|TariffResource
    {
        $tariff = new Tariff();
        $tariff->title = $request->title;
        $tariff->desc = $request->desc;
        $tariff->short_desc = $request->short_desc;
        $tariff->price = (float)$request->price;
        $tariff->is_active = $request->is_active;
        $tariff->save();

        return new TariffResource($tariff);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TariffResource
     */
    public function show(int $id): TariffResource
    {
        $tariff = Tariff::query()->findOrFail($id);
        return new TariffResource($tariff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TariffRequest $request
     * @param int $id
     * @return TariffResource
     */
    public function update(TariffRequest $request, int $id): TariffResource
    {
        $tariff = new Tariff();
        $tariff->exists = true;
        $tariff->id = $id;
        $tariff->title = $request->title;
        $tariff->desc = $request->desc;
        $tariff->short_desc = $request->short_desc;
        $tariff->price = (float)$request->price;
        $tariff->is_active = $request->is_active;
        $tariff->save();

        return new TariffResource($tariff);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
