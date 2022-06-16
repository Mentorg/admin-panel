<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Samushi\QueryFilter\Facade\QueryFilter;

class UserService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function filters ()
    {
        return [
            new Search(['name', 'roles.name']),
        ];
    }

    /**
     * Delete user by id.
     *
     * @param $id
     * @return string
     */
    public function deleteById ($id)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->delete($id);
            DB::table('posts')->where('user_id', '=', $id)->delete();
            DB::table('files')->where('user_id', '=', $id)->delete();
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete user data.');
        }
    }

    /**
     * Get & Search users with pagination
     * @param int $count
     * @return mixed
     */
    public function getWithPagination(int $count = 10)
    {
        return QueryFilter::query($this->userRepository->queryWithRoles(), $this->filters())->paginate($count);
    }

    /**
     * Get all user.
     *
     * @return String
     */
    public function getAllUser()
    {
        return $this->userRepository->getAll();
    }

    /**
     * Get user by id.
     *
     * @param $id
     * @return String
     */
    public function getById ($id)
    {
        return $this->userRepository->getById($id);
    }

    /**
     * Update user data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function updateUser ($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => ['bail', 'min:3'],
            'email' => "email",
            'password' => "min:3",
            'roles' => "required"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $user = $this->userRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update user data.');
        }
        DB::commit();

        return $user;
    }

    /**
     * Validate user data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function saveUserData (array $data)
    {
        $validator = Validator::make($data, [
            'name' => "required",
            'email' => "required",
            'password' => "required",
            'roles' => "required"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->userRepository->save($data);
    }
}
