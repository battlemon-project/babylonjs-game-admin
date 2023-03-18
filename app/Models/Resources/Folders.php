<?php

namespace App\Models\Resources;

use Illuminate\Support\Facades\Storage;

class Folders {
    public static function install(): bool
    {
        if (!Storage::exists(config('game.resources_path'))) {
            Storage::makeDirectory(config('game.resources_path'));
        }

        return true;
    }

    public static function getList(): array
    {
        $dirs = Storage::directories(config('game.resources_path'));
        $result = [];

        foreach ($dirs as $dir) {
            $name = basename($dir);
            $result[] = [
                'name' => $name,
                'path' => $dir
            ];
        }

        return $result;
    }

    public static function getListData(): array
    {
        return [
            'folders' => self::getList()
        ];
    }

    public static function create($folderName): array
    {
        $folderPath = config('game.resources_path') . '/' . $folderName;
        $error = null;
        $status = null;

        if (Storage::exists($folderPath)) {
            $error = 'Error folder, is exist ' . $folderPath;
        } else {
            $status = Storage::makeDirectory($folderPath);
        }

        return compact('status', 'error');
    }

    public static function edit($oldName, $newName): array
    {
        $oldPath = config('game.resources_path') . '/' . $oldName;
        $newPath = config('game.resources_path') . '/' . $newName;
        $error = null;
        $status = null;

        if (!Storage::exists($oldPath)) {
            $error = 'Error folder, is not exist ' . $oldPath;
        } elseif (Storage::exists($newPath)) {
            $error = 'Error folder, is exist ' . $newPath;
        } else {
            $status = Storage::move($oldPath, $newPath);
        }

        Files::makeManifest();

        return compact('status', 'error');
    }

    public static function delete($folderName): array
    {
        $folderPath = config('game.resources_path') . '/' . $folderName;
        $status = null;
        $error = null;

        if (!Storage::exists($folderPath)) {
            $error = 'Error folder, is not exist ' . $folderPath;
        } elseif (!Storage::deleteDirectory($folderPath)) {
            $error = 'Directory is not empty';
        } else {
            $status = true;
        }

        Files::makeManifest();

        return compact('status', 'error');
    }
}
