<?php

namespace App\Models\Resources;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class Files
{
    public static function install(): bool
    {
        $filesystem = new Filesystem();

        try {
            $filesystem->mkdir(config('game.resources_path'));
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at " . $exception->getPath();
        }

        return true;
    }

    public static function getList(Collection $params): array
    {
        $path = base_path(config('game.resources_path'));
        $dirs = scandir(base_path(config('game.resources_path')));
        $result = [];

        foreach ($dirs as $dir) {
            if ($dir != '.' && $dir != '..') {
                if ($params->get('folder') && $params->get('folder') !== $dir) {
                    continue;
                }

                if (is_dir($path . '/' . $dir)) {
                    $files = scandir($path . '/' . $dir);
                    $pathDir = $path . '/' . $dir;

                    foreach ($files as $file) {
                        if ($file != '.' && $file != '..') {
                            if ($params->has('name')) {
                                if (!str_contains($file, $params->get('name'))){
                                    continue;
                                }
                            }

                            $pathFile = $pathDir . '/' . $file;
                            if (file_exists($pathFile)) {
                                $result[] = [
                                    'name' => $file,
                                    'path' => $pathDir,
                                    'folder' => $dir,
                                    'date_time' => date("d.m.Y H:i:s", filemtime($pathFile))
                                ];
                            }
                        }
                    }
                }
            }
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
        $path = base_path(config('game.resources_path'));
        $folderPath = $path . '/' . $folderName;
        $error = null;
        $status = null;

        if (!is_dir($folderPath)) {
            $error = 'Error folder, not exist: ' . $path;
        }

        if (!$error) {
            if (!$fileName) {
                $fileName = $file->getClientOriginalName();
            }

            $status = $file->move($folderPath, $fileName);
        }

        return compact('status', 'error');
    }

    public static function delete($folder, $file): array
    {
        $filePath = self::getFilePath($folder, $file);
        $status = null;
        $error = null;

        if (!file_exists($filePath)) {
            $error = 'File is not exist';
        }

        if (!$error) {
            $status = unlink($filePath);
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
        $path = base_path(config('game.resources_path'));
        $folderPath = $path . '/' . $folder;
        return $folderPath . '/' . $file;
    }
}
