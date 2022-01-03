<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $builder = User::with('roles', 'countryCode:id,name,flag');

        if ($request->role) {
            $role = mb_strtolower($request->get('role'));
            $builder->whereHas('roles', function($query) use ($role) {
                return $query->where('name', $role)->orWhere('display_name', $role);
            });
        }
        if ($request->name) {
            $builder->where('name', 'like', "%$request->name%");
        }
        if ($request->phone) {
            $builder->where('phone', 'like', "%$request->phone%");
        }

        $users = $request->dashboard ? $builder->get() : $builder->paginate(20);

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

        $user = User::create($request->all());

        $user->syncRoles($request->roles);

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
        $user = User::with('countryCode', 'partnershipProposal', 'roles')->findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse|UserResource
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse|UserResource
    {
//        $checkCountry = checkAndFormatNumberCountry($request);
//        if ($checkCountry !== true) {
//            return $checkCountry;
//        }

        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->is_active = $request->is_active;

        // if ($request->change_password_type === 'auto') {
            //TODO create auto password generator
            $autoPassword = '';
//            $user->password = Hash::make($autoPassword);
        // }
        if ($request->change_password) {
            $user->password = $request->password;
        }
        $user->save();

        $user->syncRoles($request->roles);

        $user = User::with('countryCode', 'roles')->findOrfail($id);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UserResource
     */
    public function destroy(int $id)
    {
        $user = User::with('countryCode')->where('id', $id);
        $user->update([
            'is_active' => false,
        ]);
        $user->delete();
    }
}
