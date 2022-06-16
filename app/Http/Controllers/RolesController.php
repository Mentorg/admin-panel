<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RolesController extends Controller
{
    /**
     * @var roleService
     */
    protected $roleService;

    /**
     * RolesController Constructor
     *
     * @param RoleService $roleService
     *
     */
    function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('admin-panel/roles/roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $permission = Permission::get();
        return view('admin-panel/roles/create-roles', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $data = $request->only([
            'name',
            'permission'
        ]);

        try {
            return redirect('admin-panel/roles')->with([$this->roleService->saveRoleData($data)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return View
     */
    public function show($id)
    {
        $role = Role::find($id);
        $this->authorize('view', $role);

        try {
            return view('admin-panel.roles.show')->with(['roles' => $this->roleService->getById($id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @return View
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        $permission = Permission::get();
        return view('admin-panel.roles.edit',compact('role', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  $id
     * @return Redirector
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $this->authorize('update', $role);
        $data = $request->only([
            'name',
            'permission'
        ]);

        try {
            return redirect('admin-panel/roles')->with([$this->roleService->updateRole($data, $id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Redirector
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $this->authorize('delete', $role);

        try {
            return redirect('admin-panel/roles')->with(['role' => $this->roleService->deleteById($id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
}
