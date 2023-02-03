<?php

namespace App\Models\Resources;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class Folders {
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

    public static function getList(): array
    {
        $path = base_path(config('game.resources_path'));
        $dirs = scandir(base_path(config('game.resources_path')));
        $result = [];

        foreach ($dirs as $dir) {
            if ($dir != '.' && $dir != '..') {
                if (is_dir($path . '/' . $dir)) {
                    $result[] = [
                        'name' => $dir,
                        'path' => $path
                    ];
                }
            }
        }

        return $result;
    }

    #[ArrayShape(['folders' => "array"])] public static function getListData()
    {
        return [
          'folders' => self::getList()
        ];
    }

    public static function create($folderName): array
    {
        $path = base_path(config('game.resources_path'));
        $folderPath = $path . '/' . $folderName;
        $error = null;
        $status = null;

        if (!is_dir($path)) {
            $error = 'Error path, not exist: ' . $path;
        }

        if (is_dir($folderPath)) {
            $error = 'Error folder, is exist ' . $folderPath;
        }

        if (!$error) {
            $status = mkdir($folderPath, 0775);
        }

        return compact('status', 'error');
    }

    public static function edit($oldName, $newName): array
    {
        $path = base_path(config('game.resources_path'));
        $folderPath = $path . '/' . $oldName;
        $error = null;
        $status = null;

        if (!is_dir($path)) {
            $error = 'Error path, is not exist: ' . $path;
        }

        if (!is_dir($folderPath)) {
            $error = 'Error folder, is not exist ' . $folderPath;
        }

        if (!$error) {
            $status = rename($folderPath, $path . '/' . $newName);
        }

        return compact('status', 'error');
    }

    public static function delete($folderName): array
    {
        $path = base_path(config('game.resources_path'));
        $folderPath = $path . '/' . $folderName;
        $status = null;
        $error = null;

        if (!self::dirIsEmpty($folderPath)) {
            $error = 'Directory is not empty';
        }

        if (!$error) {
            $status = rmdir($folderPath);
        }

        return compact('status', 'error');
    }

    public static function dirIsEmpty($dir) {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }
}
