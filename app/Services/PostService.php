<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\PostRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Samushi\QueryFilter\Facade\QueryFilter;

class PostService
{
    /**
     * @var $postRepository
     */
    protected $postRepository;

    /**
     * PostService constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    private function filters()
    {
        return [
            new Search(['post_title', 'user.name']),
        ];
    }

    /**
     * Delete post by id.
     *
     * @param $id
     * @return string
     */
    public function deleteById ($id)
    {
        DB::beginTransaction();

        try {
            $post = $this->postRepository->delete($id);
            DB::commit();
            return $post;
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
        return QueryFilter::query($this->postRepository->queryWithUsers(), $this->filters())->orderBy('id', 'desc')->paginate($count);
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return string
     */
    public function getById ($id)
    {
        return $this->postRepository->getById($id);
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function updatePost ($data, $id)
    {
        $validator = Validator::make($data, [
            'post_title' => "bail",
            'post_content' => "bail"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $post = $this->postRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data.');
        }

        DB::commit();

        return $post;
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return string
     */
    public function savePostData(array $data)
    {
        $validator = Validator::make($data, [
            'post_title' => "required",
            'post_content' => "required"
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->postRepository->save($data);
    }
}
