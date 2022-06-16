<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Repositories\FileRepository;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FilesController extends Controller
{
    /**
     * @var fileService
     * @var fileRepository
     */
    protected $fileService;
    protected $fileRepository;

    /**
     * FilesController Constructor
     *
     * @param FileService $fileService
     * @param FileRepository $fileRepository
     *
     */
    public function __construct(FileService $fileService, FileRepository $fileRepository)
    {
        $this->fileService = $fileService;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin-panel/files/files')
                    ->with(['files' => $this->fileService->getWithPagination()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', File::class);
        return view('admin-panel/files/create-files');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store (Request $request)
    {
        $this->authorize('create', File::class);
        $data = $request->only([
            'file',
            'file_description',
        ]);

        try {
            return redirect('admin-panel/files')->with([$this->fileService->saveFileData($data)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  File  $file
     * @return View
     */
    public function show($id)
    {
        $file = File::find($id);
        $this->authorize('view', $file);
        $user_id = User::find($file->user_id);

        try {
            return view('admin-panel.files.show')
                        ->with(['files' => $this->fileService->getById($id), 'file_author' => $user_id->name]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * Download the specified resource.
     *
     * @param File $id
     */
    public function download ($id) {
        $file = File::find($id);
        $this->authorize('download', $file);
        try {
            $file = $this->fileRepository->downloadById($id);
            return response()->download(public_path('files').'/'.$file->pluck('file_name')->first());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  File  $file
     * @return View
     */
    public function edit(File $file)
    {
        $this->authorize('update', $file);
        return view('admin-panel.files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  File  $file
     * @return Redirector
     */
    public function update(Request $request, $id)
    {
        $file = File::find($id);
        $this->authorize('update', $file);
        $data = $request->only([
            'file',
            'file_description'
        ]);

        try {
            return redirect('admin-panel/files')->with([$this->fileService->updateFile($data, $id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  File  $file
     * @return Redirector
     */
    public function destroy($id)
    {
        $file = File::find($id);
        $this->authorize('delete', $file);

        try {
            return redirect('admin-panel/files')->with([$this->fileService->deleteById($id)]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
