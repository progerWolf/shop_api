<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function show(): UserResource
    {
        $user = User::with('countryCode', 'partnershipProposal')->find(auth()->user()->id);
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
        $user = User::with('countryCode')->findOrFail(auth()->user()->id);

        if ($request->change_password) {
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return response()->json([
                    'message' => 'Текущий пароль не верный.',
                ], 403);
            }

            $user->update([
                'name' => $request->name,
                'avatar' => $request->avatar,
                'password' => $request->password,
            ]);

            return new UserResource($user);
        }

        $user->update([
            'name' => $request->name,
            'avatar' => $request->avatar,
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

        auth()->logout();

        return response()->json(
            ['message' => 'Ваш аккаунт успешно удалено']
        );
    }
}
