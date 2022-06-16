<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class RoleService
{
    /**
     * @var $roleRepository
     */
    protected $roleRepository;

    /**
     * RoleService constructor.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Delete role by id.
     *
     * @param $id
     * @return string
     */
    public function deleteById ($id)
    {
        DB::beginTransaction();

        try {
            $role = $this->roleRepository->delete($id);
            DB::commit();
            return $role;
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete role data.');
        }
    }

    /**
     * Get all role.
     *
     * @return String
     */
    public function getAllRoles()
    {
        return $this->roleRepository->getAll();
    }

    /**
     * Get role by id.
     *
     * @param $id
     * @return String
     */
    public function getById ($id)
    {
        return $this->roleRepository->getById($id);
    }

    /**
     * Update role data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function updateRole ($data, $id)
    {
        $validator = Validator::make($data, [
            'name' => "min:3",
            'permission' => "required_without_all"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $role = $this->roleRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update role data.');
        }
        DB::commit();

        return $role;
    }

    /**
     * Validate role data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function saveRoleData (array $data)
    {
        $validator = Validator::make($data, [
            'name' => "required",
            'permission' => "required"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->roleRepository->save($data);
    }
}
