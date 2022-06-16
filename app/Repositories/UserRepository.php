<?php

namespace App\Repositories;

use App\Filters\Search;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Samushi\QueryFilter\Facade\QueryFilter;

class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get Query Builder
     * @return Builder
     */
    public function query()
    {
        return $this->user->newQuery();
    }

    public function queryWithRoles()
    {
        return $this->user->with('roles')->newQuery();
    }

    /**
     * Get all users.
     *
     * @return User $user
     */
    public function getAll()
    {
        $users = User::paginate(3);
        return $users;
    }

    /**
     * Pagination
     * @param int $count
     * @return mixed
     */
    public function paginate(int $count = 10)
    {
        return $this->user->paginate($count);
    }

    /**
     * Get user by id.
     *
     * @param $id
     * @return mixed
     */
    public function getbyId($id)
    {
        return $this->user->where('id', $id)->get();
    }

    /**
     * Save User
     *
     * @param $user
     * @return User
     */
    public function save ($data)
    {
        $user = new $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->assignRole($data['roles']);
        $user->save();
        return $user->fresh();
    }

    /**
     * Update User
     *
     * @param $data
     * @return User
     */
    public function update ($data, $id)
    {
        $user = $this->user->find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->syncRoles($data['roles']);
        $user->update();

        return $user;
    }

    /**
     * Delete User
     *
     * @param $id
     * @return User
     */
    public function delete($id)
    {
        $user = $this->user->find($id);
        $user->delete();

        return $user;
    }
}
