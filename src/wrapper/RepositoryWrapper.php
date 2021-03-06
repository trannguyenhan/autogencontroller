<?php

namespace Trannguyenhan\AutogenController\wrapper;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Trannguyenhan\AutogenController\helpers\Constants;

class RepositoryWrapper extends Wrapper
{

    public function buildParent($content, $parent)
    {
        return str_replace('{{parent}}', $parent, $content);
    }

    public function buildNamespace($content, $namespace)
    {
        $fullNamespace = "App\Http\Repositories";
        if($namespace != "" && $namespace != null){
            $fullNamespace .= "\\" . $namespace;
        }

        return str_replace("{{namespace}}", $fullNamespace, $content);
    }

    public function buildClassName($content, $modelName, $controllerName = null)
    {
        $fullControllerName = $controllerName;
        if($fullControllerName != null){
            return str_replace('{{class}}', $fullControllerName, $content);
        }

        $fullControllerName = $modelName . "Repository";
        return str_replace('{{class}}', $fullControllerName, $content);
    }

    public function buildImport($content, $modelName)
    {
        $modelName = "\App\Models\\" . $modelName;

        $fullImport = "use " . $modelName . ";\n";
        $fullImport .= "use Illuminate\Http\Request;";

        return str_replace("{{imports}}", $fullImport, $content);
    }

    /**
     * @throws FileNotFoundException
     */
    public function buildBody($content)
    {
        // build CRUD function
        $createFunc = $this->buildFunction("store", Constants::REPOSITORY);
        $listingFunc = $this->buildFunction("listing", Constants::REPOSITORY);
        $updateFunc = $this->buildFunction("update", Constants::REPOSITORY);
        $deleteFunc = $this->buildFunction("delete", Constants::REPOSITORY);

        // merge function to body
        $tmpBody = $listingFunc . "\n" . $createFunc . "\n" . $updateFunc . "\n" . $deleteFunc;
        return str_replace("{{body}}", $tmpBody, $content);
    }
}
