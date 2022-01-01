<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $faqs = Faq::where('is_active', true)->get();
        return FaqResource::collection($faqs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFaqRequest $request
     * @return FaqResource|JsonResponse
     */
    public function store(StoreFaqRequest $request): FaqResource|JsonResponse
    {
        $faq = new Faq();
        $faq->title = $request->title;
        $faq->body = $request->body;
        $faq->is_active = $request->is_active;

        if (!$faq->save()) {
            return response()->json([
                'message' => 'Произошла ошибка создании поста проверте данные'
            ], 400);
        }

        return new FaqResource($faq);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FaqResource
     */
    public function show(int $id): FaqResource
    {
        $faq = Faq::findOrFail($id);
        return new FaqResource($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreFaqRequest $request
     * @param int $id
     * @return FaqResource|JsonResponse
     */
    public function update(StoreFaqRequest $request, int $id): FaqResource|JsonResponse
    {
        $faq = new Faq();
        $faq->exists = true;
        $faq->id = $id;
        $faq->title = $request->title;
        $faq->body = $request->body;
        $faq->is_active = $request->is_active;

        if (!$faq->save()) {
            return response()->json([
                'message' => 'Произошла ошибка создании поста проверте данные'
            ], 400);
        }

        return new FaqResource($faq);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
