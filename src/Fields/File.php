<?php

namespace MustafaKhaled\AtomicPanel\Fields;


use Illuminate\Support\Facades\Storage;

class File Extends AtomicField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.file';

    /**
     * file default path
     * @var string
     */
    public $path = 'files';

    /**
     * file default storage disk
     * @var string
     */
    public $disk = 'public';

    /**
     * handle request value
     * @param $file
     * @return mixed
     */
    public function HandleRequestValue($file)
    {
        if (isset($file)) {
            $path = Storage::disk($this->disk)->putFile($this->path, $file);
            return $path;
        }
        return $this->value;

    }

    /**
     * change field path
     * @param $path
     * @return $this
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * change field disk
     * @param $disk
     * @return $this
     */
    public function disk($disk)
    {
        $this->disk = $disk;
        return $this;
    }

}