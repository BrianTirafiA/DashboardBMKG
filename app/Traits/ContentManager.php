<?php

namespace App\Traits;
use Cloudinary;

trait ContentManager
{
    public function path($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public function upload($content, $filename, $folder)
    {
        $newFileName = str_replace(' ', '_', $filename);
        $publicId    = date('Y-m-d_His').'_'.$newFileName;
        $url         = Cloudinary::upload($content, [
                        "resource_type" => 'auto',
                        "public_id"     => $this->path($publicId),
                        "folder"        => $folder,
                        "quality"       => 30,
                    ])->getSecurePath();

        return $url;
    }

    public function replace($path, $content, $filename, $filetype, $folder)
    {
        $this->deleteContent($path, $filetype, $folder);
        return $this->upload($content, $filename, $folder);
    }

    public function deleteContent($path, $filetype, $folder)
    {
        $publicId = $folder.'/'.$this->path($path);
        return Cloudinary::destroy($publicId, [
            'resource_type' => $filetype
        ]);
    }
}