<?php

namespace App\Repositories;

use App\Filters\Search;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Samushi\QueryFilter\Facade\QueryFilter;

class PostRepository
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get Query Builder
     * @return Builder
     */
    public function query()
    {
        return $this->post->newQuery();
    }

    public function queryWithUsers()
    {
        return $this->post->with('user')->newQuery();
    }

    /**
     * Get all posts.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->post->all();
    }

    /**
     * Pagination
     * @param int $count
     * @return mixed
     */
    public function paginate(int $count = 10)
    {
        return $this->post->paginate($count);
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->post->where('id', $id)->get();
    }

    /**
     * Save Post
     *
     * @param $data
     * @return Post
     */
    public function save ($data)
    {
        $post = new $this->post;

        $post->user_id = auth()->user()->id;
        $post->post_title = $data['post_title'];
        $post->post_content = $data['post_content'];
        $post->save();
        return $post->fresh();
    }

    /**
     * Update Post
     *
     * @param $data
     * @return Post
     */
    public function update ($data, $id)
    {
        $post = $this->post->find($id);

        $post->post_title = $data['post_title'] . " (updated)";
        $post->post_content = $data['post_content'];

        $post->update();

        return $post;
    }

    /**
     * Delete Post
     *
     * @param $id
     * @return Post
     */
    public function delete($id)
    {
        $post = $this->post->find($id);
        $post->delete();

        return $post;
    }
}
