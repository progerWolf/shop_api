<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function show(): UserResource
    {
        $user = User::with('countryCode')->find(auth()->user()->id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @return UserResource|JsonResponse
     */
    public function update(UpdateProfileRequest $request): UserResource|JsonResponse
    {
        $checkCountry = checkAndFormatNumberCountry($request);
        if ($checkCountry !== true) {
            return $checkCountry;
        }

        $user = User::with('countryCode')->findOrFail(auth()->user()->id);

        if ($request->change_password) {
            $request->validate([
                'current_password' => 'required|string|min:6' ,
                'password' => 'required|string|confirmed|min:6',
            ]);

            if ($user->password !== $request->current_password) {
                return response()->json([
                    'message' => 'Текущий пароль не верный.',
                ], 403);
            }

            $user->update([
                'name' => $request->name,
                'avatar' => $request->avatar,
                'phone' => $request->phone,
                'password' => $request->password,
                'country_code_id' => $request->country_code
            ]);

            return new UserResource($user);
        }

        $user->update([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'phone' => $request->phone,
            'country_code_id' => $request->country_code
        ]);


        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        $user = User::with('countryCode')->where('id', auth()->user()->id);

        $user->update([
            'is_active' => false,
            'deleted_at' => Carbon::now()->format("Y-m-d H:i:s")
        ]);

        return response()->json(
            ['message' => 'Ваш аккаунт успешно удалено']
        );
    }
}
