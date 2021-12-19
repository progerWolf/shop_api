<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $permissions = Permission::paginate(20);
        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return JsonResponse
     */
    public function store(StorePermissionRequest $request): JsonResponse
    {
        if ($request->permission_type === 'basic') {
            $request->validate([
                'display_name' => 'required|max:255',
                'name' => 'required|max:255|alphadash|unique:permissions,name',
                'description' => 'sometimes|max:255'
            ]);

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;

            if (!$permission->save()) {
                return response()->json(
                    ['message' => 'Произла ошибка при создании проверте корректность данные'],
                    400
                );
            }

            return response()->json(
                ['message' => 'Новый права успешно создан']
            );
        }
        if ($request->permission_type === 'crud') {
            $request->validate([
                'resource' => 'required|min:3|max:100|alpha'
            ]);

            $crud = explode(',', $request->crud_selected);

            if (count($crud) !== 0) {
                foreach ($crud as $permission) {
                    $slug = strtolower($request->resource) . '-' . strtolower($permission);
                    $displayName = ucwords($permission . ' ' . $request->resource);
                    $description = 'Даёт пользоватлю права на ' . strtolower($permission) . ' ' . strtolower($request->resource);

                    $permission = new Permission();
                    $permission->name = $slug;
                    $permission->display_name = $displayName;
                    $permission->description = $description;
                    $permission->save();
                }

                return response()->json(
                    ['message' => 'Новые права успешно созданы']
                );

            }
        }

        return response()->json(['message' => 'Пустой запрос'],400);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PermissionResource
     */
    public function show(int $id): PermissionResource
    {
        $permission = Permission::findOrFail($id);
        return new PermissionResource($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param int $id
     * @return PermissionResource|JsonResponse
     */
    public function update(UpdatePermissionRequest $request, int $id): PermissionResource|JsonResponse
    {
        $permission = new Permission;

        $permission->exists = true;
        $permission->id = $id;
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;

        if (isset($request->description) && !empty($request->description)) {
            $permission->description = $request->description;
        }

        if (!$permission->save()) {
            return response()->json([
                'message' => 'Произошла ошибка обновении проверте данные'
            ], 400);
        }

        return new PermissionResource($permission);
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
