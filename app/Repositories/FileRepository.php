<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class FileRepository
{
    /**
     * @var File
     */
    protected $file;

    /**
     * FileRepository constructor.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Get Query Builder
     * @return Builder
     */
    public function query()
    {
        return $this->file->newQuery();
    }

    public function queryWithUsers()
    {
        return $this->file->with('user')->newQuery();
    }

    /**
     * Get all files.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->file->all();
    }

    /**
     * Pagination
     * @param int $count
     * @return mixed
     */
    public function paginate(int $count = 10)
    {
        return $this->file->paginate($count);
    }

    /**
     * Get file by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->file->where('id', $id)->get();
    }

    /**
     * Save File
     *
     * @param $data
     * @return File
     */
    public function save ($data)
    {
        $file = new $this->file;
        $file->file_name = $data['file']->getClientOriginalName();
        $file->file_description = $data['file_description'];
        $file->file_type = $data['file']->getClientOriginalExtension();
        $file->file_size = $data['file']->getSize();
        $file->user_id = auth()->user()->id;
        $file->save();

        Storage::disk('files')->putFileAs('', $data['file'], $data['file']->getClientOriginalName());

        return $file->fresh();
    }

    /**
     * Update File
     *
     * @param $data
     * @return File
     */
    public function update ($data, $id)
    {
        $file = $this->file->find($id);
        $file->file_description = $data['file_description'] . " (updated)";
        $file->update();

        return $file;
    }

    public function downloadById ($id)
    {
        return $this->file->where('id', $id)->get();
    }

    /**
     * Delete File
     *
     * @param $id
     * @return File
     */
    public function delete($id)
    {
        $file = $this->file->find($id);
        $file->delete();

        return $file;
    }
}
