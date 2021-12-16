<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse|UserResource
     */
    public function store(StoreUserRequest $request): JsonResponse|UserResource
    {
        $checkCountry = checkAndFormatNumberCountry($request);
        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $request->password,
            'is_active' => $request->is_active,
            'country_code_id' => $request->country_code
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = User::with('countryCode')->findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param StoreUserRequest $request
     * @return JsonResponse|UserResource
     */
    public function update(StoreUserRequest $request, int $id): JsonResponse|UserResource
    {
        $checkCountry = checkAndFormatNumberCountry($request);
        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $user = User::with('countryCode')->where('id', $id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'is_active' => $request->is_active,
            'password' => $request->password,
            'country_code_id' => $request->country_code
        ]);


        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UserResource
     */
    public function destroy(int $id): UserResource
    {
        $user = User::with('countryCode')->where('id', $id);
        $user->update([
            'is_active' => false,
            'deleted_at' => Carbon::now()->format("Y-m-d H:i:s")
        ]);
        return new UserResource($user);
    }
}
