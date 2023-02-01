<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Resources\Folders;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class FoldersController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('resources.files.index', Folders::getListData());
    }

    public function create(): Factory|View|Application
    {
        return view('resources.files.create');
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|regex:/^[a-z0-9_]*$/']);
        $folderName = $request->get('name');

        $create = Folders::create($folderName);

        if ($create['status']) {
            return redirect(route('folders.index'))->with('message', 'Folder ' . $folderName . ' created!');
        }

        return back()->with('error', $create['error']);
    }


    public function delete($folder): Redirector|RedirectResponse|Application
    {
        $delete = Folders::delete($folder);

        if(!$delete['error']) {
            return redirect(route('folders.index'))->with('message', 'Folder ' . $folder . ' deleted!');
        }

        return back()->with('error', 'Folder not deleted: ' . $delete['error']);
    }
}
