<?php

namespace Trannguyenhan\AutogenController;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Trannguyenhan\AutogenController\helpers\Constants;
use Trannguyenhan\AutogenController\helpers\Helpers;
use Trannguyenhan\AutogenController\models\Factory;
use Trannguyenhan\AutogenController\wrapper\ControllerWrapper;
use Trannguyenhan\AutogenController\wrapper\RepositoryWrapper;

class AutogenControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tnhgen:controller
                            {--c|basecontroller= : The name of the base controller}
                            {--r|baserepository= : The name of the base repository}
                            {--m|model= : The name of the model}
                            {--np|namespace= : Namespace of controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate controller';

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $baseController = $this->getBaseController();
        $baseRepository = $this->getBaseRepository();
        $model = $this->getModel();
        $namespace = $this->getNamespace();

        // set factory
        $factory = new Factory($model);

        // build repository
        $rwrapper = new RepositoryWrapper($namespace, $baseRepository, $model);
        $path = Helpers::buildPath($namespace, Constants::REPOSITORY);
        $factory->setWrapperAndPath($path, $rwrapper);
        $factory->setFileType(Constants::REPOSITORY);
        $factory->createAndPutContent();

        // build controller
        $cwrapper = new ControllerWrapper($namespace, $baseController, $model);
        $path = Helpers::buildPath($namespace, Constants::CONTROLLER);
        $factory->setWrapperAndPath($path, $cwrapper);
        $factory->setFileType(Constants::CONTROLLER);
        $factory->createAndPutContent();
    }

    public function getBaseController(){
        return $this->option('basecontroller')? $this->option('basecontroller') : "Controller";
    }

    public function getBaseRepository(){
        return $this->option('baserepository')? $this->option('baserepository') : "BaseRepository";
    }

    public function getModel(){
        return $this->option('model')? $this->option('model') : "User";
    }

    public function getNamespace(){
        return $this->option('namespace')? $this->option('namespace') : "";
    }
}
