<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * @var userService
     */
    protected $userService;

    /**
     * UsersController Constructor
     *
     * @param UserService $userService
     *
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin-panel/users/users')->with(['users' => $this->userService->getWithPagination()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin-panel/users/create-users', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store (Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'roles'
        ]);

        try {
            return redirect('admin-panel/users')->with([$this->userService->saveUserData($data)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show($id)
    {
        $user_id = User::find($id);

        try {
            return view('admin-panel.users.show')
                        ->with(['users' => $this->userService->getById($id), 'user_role' => $user_id->roles]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return View
     */
    public function edit (User $user) {
        $roles = Role::all();
        return view('admin-panel/users/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Redirector
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'roles'
        ]);
        try {
            return redirect('admin-panel/users')->with([$this->userService->updateUser($data, $id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Redirector
     */
    public function destroy($id)
    {
        try {
            return redirect('admin-panel/users')->with([$this->userService->deleteById($id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
