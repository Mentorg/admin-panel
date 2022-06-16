<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PostsController extends Controller
{
    /**
     * @var postService
     */
    protected $postService;

    /**
     * PostsController Constructor
     *
     * @param PostService $postService
     *
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin-panel/posts/posts')
                    ->with(['posts' => $this->postService->getWithPagination()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('admin-panel/posts/create-posts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store (Request $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->only([
            'post_title',
            'post_content',
        ]);

        try {
            return redirect('admin-panel/posts')->with([$this->postService->savePostData($data)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return View
     */
    public function show($id)
    {
        $post = Post::find($id);
        $this->authorize('view', $post);
        $user_id = User::find($post->user_id);

        try {
            return view('admin-panel.posts.show')
                        ->with(['posts' => $this->postService->getById($id), 'post_author' => $user_id->name]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit (Post $post) {
        $this->authorize('update', $post);
        return view('admin-panel.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Redirector
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('update', $post);
        $data = $request->only([
            'post_title',
            'post_content'
        ]);

        try {
            return redirect('admin-panel/posts')->with([$this->postService->updatePost($data, $id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Redirector
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);

        try {
            return redirect('admin-panel/posts')->with([$this->postService->deleteById($id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
