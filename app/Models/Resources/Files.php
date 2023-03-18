<?php
namespace App\Models\Resources;

use Exception;
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

    /**
     * @throws Exception
     */
    public static function getList(Collection $params): array
    {
        if (!$params->get('folder')) {
            throw new Exception('Folder parameter is required');
        }

        $path = config('game.resources_path') . '/' . $params->get('folder');
        $files = Storage::allFiles($path);

        $result = [];

        foreach ($files as $file) {
            if ($params->get('name')) {
                if (!str_contains(basename($file), $params->get('name'))) {
                    continue;
                }
            }

            $result[] = [
                'name' => basename($file),
                'path' => $path,
                'folder' => $params->get('folder'),
                'date_time' => date("d.m.Y H:i:s", Storage::lastModified($file))
            ];
        }

        return $result;
    }


    /**
     * @throws Exception
     */
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

        self::makeManifest();

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

        self::makeManifest();

        return compact('status', 'error');
    }

    public static function getFoldersForSelect(): array
    {
        $folders = collect(Folders::getList())->pluck('name')->toArray();
        return array_combine($folders, $folders);
    }

    public static function getFilePath($folder, $file): string
    {
        return config('game.resources_path')  . '/' . $folder . '/' . $file;
    }

    public static function makeManifest()
    {
        $path = config('game.resources_path');
        $files = Storage::allFiles($path);
        $manifest = [];

        foreach ($files as $file) {
            $name = str_replace($path . '/', '', $file);
            $manifest[$name] = Storage::lastModified($file);
        }

        $data = json_encode($manifest, JSON_PRETTY_PRINT);
        Storage::put($path . '/manifest.json', $data);
    }
}
