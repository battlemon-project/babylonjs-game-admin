<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UploadResourcesController extends Controller
{
    public function index()
    {
        return view('upload_resources');
    }

    public function upload(Request $request): Redirector|Application|RedirectResponse
    {
        $pathGraphics = env('GAME_PATH_RESOURCES') . '/resources/graphics/';

        if (!$this->validateFields($request)) {
            return redirect(route('dashboard'))->with('error', 'Resources not selected');
        }

        $this->uploadFile($request, 'map', $pathGraphics . 'levels/level_1', 'map.babylon');
        $this->uploadFile($request, 'character', $pathGraphics . 'characters', 'player.glb');
        $this->uploadFile($request, 'environment', $pathGraphics .'textures', 'environment.env');

        return redirect(route('dashboard'))->with('message', 'Resources uploaded');
    }

    public function validateFields($request): bool|array|RedirectResponse
    {
        if (!$request->file('map') && !$request->file('character') && !$request->file('environment')) {
            return false;
        }

        return true;
    }

    public function uploadFile(Request $request, $name, $path, $fileName)
    {
        if ($request->file($name)) {
            $request->file($name)
                ->move(public_path($path), $fileName);
        }
    }
}
