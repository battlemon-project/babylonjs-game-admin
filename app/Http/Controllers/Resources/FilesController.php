<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Files;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FilesController extends Controller
{
    public function index(Request $request): View|Factory|Redirector|Application|RedirectResponse
    {
        if (!$request->get('folder')) {
            $path = config('game.resources_path');
            $directories = Storage::directories($path);
            $firstDirectory = basename($directories[0]);

            return redirect(route('files.index', ['folder' => $firstDirectory]));
        }

        return view('resources.files.index', Files::getListData($request->all()));
    }

    public function create(Request $request): Factory|View|Application
    {
        $folders = Files::getFoldersForSelect();
        $folder = $request->get('folder');

        return view('resources.files.create', compact('folder','folders'));
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $this->validate($request, ['file' => 'required', 'folder' => 'required']);
        $folder = $request->get('folder');
        $file = $request->file('file');

        $create = Files::create($folder, $file, $request->get('file_name_in_game'));

        if (!$create['error']) {
            return redirect(route('files.create', compact('folder')))
                ->with('message', 'File ' . $file->getClientOriginalName() . '  created');
        }

        return back()->with('error', 'File not created: ' . $create['error']);

    }

    public function edit(Request $request, $file): Factory|View|Application
    {
        $folders = Files::getFoldersForSelect();
        $folder = $request->get('folder');

        return view('resources.files.edit', compact('folders', 'folder', 'file'));
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function update(Request $request): Redirector|RedirectResponse|Application
    {
        $this->validate($request, [
            'file' => 'required',
            'folder' => 'required',
            'file_name_in_game' => 'required'
        ]);

        $folder = $request->get('folder');
        $file = $request->file('file');

        $create = Files::create($folder, $file, $request->get('file_name_in_game'));

        if (!$create['error']) {
            return redirect(route('files.index', compact('folder')))
                ->with('message', 'File created');
        }

        return back()->with('error', 'File not created: ' . $create['error']);

    }

    public function delete(Request $request, $file): Redirector|RedirectResponse|Application
    {
        $folder = $request->get('folder');
        $delete = Files::delete($folder, $file);

        if(!$delete['error']) {
            return redirect(route('files.index', compact('folder')))
                ->with('message', 'File ' . $file . ' deleted!');
        }

        return back()->with('error', 'File not deleted: ' . $delete['error']);
    }

    public function download(Request $request, $file): BinaryFileResponse
    {
        $folder = $request->get('folder');
        $filePath = Files::getFilePath($folder, $file);

        return response()->download($filePath);
    }
}
