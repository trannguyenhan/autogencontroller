<?php

namespace Trannguyenhan\AutogenController\wrapper;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

abstract class Wrapper
{
    protected $namespace;
    protected $import;
    protected $parent;
    protected $body;
    protected $template;
    protected $modelName;
    protected $filesystem;

    private $content;

    /**
     * @throws FileNotFoundException
     */
    public function __construct($namespace, $parent, $modelName)
    {
        $this->namespace = $namespace;
        $this->parent = $parent;
        $this->modelName  = $modelName;

        $this->filesystem = new Filesystem();
        $this->template = $this->filesystem->get($this->path([__DIR__, 'templates', "controller"]));
        $this->template = $this->buildParent($this->template, $parent);
        $this->template = $this->buildNamespace($this->template, $namespace);
        $this->template = $this->buildClassName($this->template, $modelName);
        $this->template = $this->buildImport($this->template, $modelName);
        $this->template = $this->buildBody($this->template);

        $this->content = $this->template;
    }

    public function getContent(){
        return $this->content;
    }

    public abstract function buildParent($content, $parent);
    public abstract function buildNamespace($content, $namespace);
    public abstract function buildClassName($content, $modelName, $controllerName = null);
    public abstract function buildImport($content, $modelName);
    public abstract function buildBody($content);

    /**
     * @throws FileNotFoundException
     */
    public function buildFunction($functionName, $type){
        $templateName = $functionName . "_" . "function" . "_" . $type;
        $functionContent = $this->filesystem->get($this->path([__DIR__, 'templates', $templateName]));

        return str_replace("{{model}}", $this->modelName, $functionContent);
    }

    /**
     * @param array $pieces
     *
     * @return string
     */
    protected function path(array $pieces): string
    {
        return implode(DIRECTORY_SEPARATOR, $pieces);
    }
}
