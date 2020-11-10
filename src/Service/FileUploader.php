<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * @package App\Service
 */
class FileUploader
{
    const FORMAT_IMAGES = "jpeg";

    private $targetDirectory;
    private $targetCacheDirectory;

    public function __construct($targetDirectory, $targetCacheDirectory)
    {
        $this->targetDirectory = $targetDirectory;
        $this->targetCacheDirectory = $targetCacheDirectory;
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     * @return string
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $filename = ''): string
    {
        if ($file->guessExtension() !== self::FORMAT_IMAGES) {
            return '';
        }

        $newFilename = $filename . '.' . $file->guessExtension();

        try {
            $file->move(
                $this->getTargetDirectory(),
                $newFilename
            );
        } catch (FileException $e) {
            die($e->getMessage());
        }

        return $newFilename;
    }

    /**
     * @param string $imageName
     */
    public function delete(string $imageName = '', string $mode = '')
    {
        $pathFolder = $this->getTargetDirectory();
        if ($mode === 'cache') {
            $pathFolder =  $this->getTargetCacheDirectory();
        }

        $image = $pathFolder. '/' . $imageName;
        
        if (file_exists($image)) {
            unlink($image);
        }
    }

    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    /**
     * @return mixed
     */
    public function getTargetCacheDirectory()
    {
        return $this->targetCacheDirectory;
    }
}
