<?php

namespace Trannguyenhan\AutogenController\models;

use Illuminate\Filesystem\Filesystem;
use Trannguyenhan\AutogenController\wrapper\Wrapper;

/**
 * @property FileSystem $fileSystem
 * @property string $content
 * @property string $path
 */
class Factory
{
    protected $path;
    protected $content;
    protected $filesystem;
    protected $file;
    protected $model;

    /**
     * @param string $model
     */
    public function __construct(string $model)
    {
        $this->filesystem = new FileSystem();
        $this->model = $model;
    }

    public function createAndPutContent(){
        if (! $this->filesystem->isDirectory($this->path)) {
            $this->filesystem->makeDirectory($this->path, 0755, true);
        }

        $this->filesystem->put($this->path . "/" . $this->file, $this->content);
    }

    public function setFileType($fileType){
        $this->file = $this->model . ucfirst($fileType) . ".php";
    }

    public function setWrapperAndPath(string $path, Wrapper $wrapper){
        $this->path = $path;
        $this->content = $wrapper->getContent();
    }
}
