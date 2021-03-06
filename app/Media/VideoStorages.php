<?php

namespace App\Media;

use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage()
    {
        return \Storage::disk($this->getDiskDriver());
    }

    protected function getDiskDriver()
    {
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath)
    {
        return $this->isLocalDriver()?
            $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath):
            $storage->url($fileRelativePath);
    }

    public function isLocalDriver()
    {
        $driver = config("filesystems.disks.{$this->getDiskDriver()}.driver");
        return $driver == 'local';
    }

}