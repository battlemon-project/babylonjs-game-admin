<?php
namespace App\Models\Resources;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Files
{
    public static function install(): bool
    {
        $path = config('game.resources_path');

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }

        return true;
    }

    public static function getList(Collection $params): array
    {
        $path = config('game.resources_path');
        $dirs = Storage::directories($path);
        $files = Storage::allFiles($path);

        $result = [];

        foreach ($files as $file) {
            $dir = dirname($file);
            if (!in_array($dir, $dirs)) {
                continue;
            }

            if (basename($file) === '.DS_Store') {
                continue;
            }

            if ($params->get('folder') && $params->get('folder') !== basename($dir)) {
                continue;
            }

            if ($params->has('name')) {
                if (!str_contains(basename($file), $params->get('name'))) {
                    continue;
                }
            }

            $result[] = [
                'name' => basename($file),
                'path' => $dir,
                'folder' => basename($dir),
                'date_time' => date("d.m.Y H:i:s", Storage::lastModified($file))
            ];
        }

        return $result;
    }

    public static function getListData($params): array
    {
        $params = collect($params);

        return [
            'files' => self::getList($params),
            'folders' => self::getFoldersForSelect()
        ];
    }

    public static function create($folderName, UploadedFile $file, $fileName): array
    {
        $path = config('game.resources_path');
        $folderPath = $path . '/' . $folderName;
        $error = null;
        $status = null;

        if (!Storage::exists($folderPath)) {
            $error = 'Error folder, not exist: ' . $path;
        }

        if (!$error) {
            if (!$fileName) {
                $fileName = $file->getClientOriginalName();
            }

            $status = Storage::putFileAs($folderPath, $file, $fileName);
        }

        return compact('status', 'error');
    }

    public static function delete($folder, $file): array
    {
        $filePath = self::getFilePath($folder, $file);
        $status = null;
        $error = null;

        if (!Storage::exists($filePath)) {
            $error = 'File is not exist';
        }

        if (!$error) {
            $status = Storage::delete($filePath);
        }

        return compact('status', 'error');
    }

    public static function getFoldersForSelect(): array
    {
        $folders = collect(Folders::getList())->pluck('name')->toArray();
        return array_combine($folders, $folders);
    }

    public static function getFilePath($folder, $file): string
    {
        $path = Storage::path(config('game.resources_path'));
        $folderPath = $path . '/' . $folder;
        return $folderPath . '/' . $file;
    }
}
