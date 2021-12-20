<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $roles = Role::paginate(20);
        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return RoleResource|JsonResponse
     */
    public function store(StoreRoleRequest $request): RoleResource|JsonResponse
    {
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->descrptin = $request->descrptin;

        if ($request->selectedPermissionsIds) {
            $role->syncPermissions(explode(',', $request->selectedPermissionsIds));
        }

        if (!$role->save()) {
            return response()->json([
                'message' => 'Произошла ошибка содании проверте данные'
            ], 400);
        }

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RoleResource
     */
    public function show(int $id): RoleResource
    {
        $role = Role::with('permissions')->findOrFail($id);
        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return RoleResource|JsonResponse
     */
    public function update(UpdateRoleRequest $request, int $id): RoleResource|JsonResponse
    {
        $role = new Role();

        $role->exists = true;
        $role->id = $id;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->descrptin = $request->descrptin;

        if ($request->selectedPermissionsIds) {
            $role->syncPermissions(explode(',', $request->selectedPermissionsIds));
        }

        if (!$role->save()) {
            return response()->json([
                'message' => 'Произошла ошибка обновении проверте данные'
            ], 400);
        }

        return new RoleResource($role);

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
}
