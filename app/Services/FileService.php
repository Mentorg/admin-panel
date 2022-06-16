<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\FileRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Samushi\QueryFilter\Facade\QueryFilter;

class FileService
{
    /**
     * @var $fileRepository
     */
    protected $fileRepository;

    /**
     * FileService constructor.
     *
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    private function filters ()
    {
        return [
            new Search(['file_name', 'user.name']),
        ];
    }

    /**
     * Delete file by id.
     *
     * @param $id
     * @return string
     */
    public function deleteById ($id)
    {
        DB::beginTransaction();

        try {
            $file = $this->fileRepository->delete($id);
            DB::commit();
            return $file;
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * Get & Search posts with pagination
     * @param int $count
     * @return mixed
     */
    public function getWithPagination(int $count = 10)
    {
        return QueryFilter::query($this->fileRepository->queryWithUsers(), $this->filters())->paginate($count);
    }

    /**
     * Get file by id.
     *
     * @param $id
     * @return string
     */
    public function getById ($id)
    {
        return $this->fileRepository->getById($id);
    }

    /**
     * Update file
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function updateFile ($data, $id): string
    {
        $validator = Validator::make($data, [
            'file_description' => "bail|max:1000"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $file = $this->fileRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update file data.');
        }

        DB::commit();

        return $file;
    }

    /**
     * Validate file data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function saveFileData(array $data)
    {
        $validator = Validator::make($data, [
            'file' => "required",
            'file_description' => "required"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->fileRepository->save($data);
    }
}
