<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::where(['is_active'=> true])->orderBy('created_at', 'desc')->paginate(6);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return PostResource|JsonResponse
     */
    public function store(StorePostRequest $request): PostResource|JsonResponse
    {
        $shortDesc = substr($request->description, 0, 30);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->short_description = $shortDesc . '...';
        $post->image = $request->image;
        $post->is_active = $request->is_active;
        $post->type = $request->type;

        if (!$post->save()) {
            return response()->json([
                'message' => 'Произошла ошибка создании поста проверте данные'
            ], 400);
        }

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PostResource
     */
    public function show($slug) : PostResource
    {
        $post = Post::where(['is_active'=> true, 'slug'=> $slug])->first();
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePostRequest $request
     * @param int $id
     * @return PostResource|JsonResponse
     */
    public function update(StorePostRequest $request, int $id): PostResource|JsonResponse
    {
        $shortDesc = substr($request->description, 0, 30);

        $post = new Post();
        $post->exists = true;
        $post->id = $id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->short_description = $shortDesc . '...';
        $post->image = $request->image;
        $post->is_active = $request->is_active;
        $post->type = $request->type;

        if (!$post->save()) {
            return response()->json([
                'message' => 'Произошла ошибка обновлении поста проверте данные'
            ], 400);
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function about()
    {
        $post = Post::where(['is_active'=> true, 'type'=> 'about'])->latest()->first();

        return new PostResource($post);
    }
}
