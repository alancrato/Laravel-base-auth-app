<?php

namespace App\Media;


trait SeriePaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute()
    {
        return "series/{$this->id}";
    }

    public function getThumbAssetAttribute()
    {
        return $this->isLocalDriver()?
            route('admin.series.thumb_asset',['series' => $this->id]):
            $this->thumb_path;
    }
    public function getThumbSmallAssetAttribute()
    {
        return $this->isLocalDriver()?
            route('admin.series.thumb_small_asset',['series' => $this->id]):
            $this->thumb_small_path;
    }

    public function getThumbDefaultAttribute()
    {
        return env('SERIE_NO_THUMB');
    }

}