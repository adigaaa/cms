<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use File;
class ApiGenerator extends Command
{
    public $name;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator for Api structure';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = ucfirst($this->argument('name')) ;
        $rootName = $this->name.'s';
        Storage::disk('api')->makeDirectory($rootName);

        Storage::disk('api')->put($rootName.'/Controllers/'.$this->name.'Controller.php', $this->getControllerStructure());
        $this->info( $this->name.'Controller Created' );

        Storage::disk('api')->put($rootName.'/Models/'.$this->name.'.php', $this->getModelStructure());

        Storage::disk('api')->put($rootName.'/Services/'.$this->name.'Service.php', $this->getServiceStructure());

        Storage::disk('api')->put($rootName.'/Repositories/'.$this->name.'Repository.php', $this->getRepositoryStructure());

        Storage::disk('api')->makeDirectory($rootName.'/Requests');

        Storage::disk('api')->makeDirectory($rootName.'/Transformers');

        Storage::disk('api')->makeDirectory($rootName.'/Validations');


    }

    public function getControllerStructure()
    {
        return <<<PHP
<?php

namespace Api\\{$this->name}s\Controllers;

use Api\BaseController;
use Api\\{$this->name}s\Services\\{$this->name}Service;

class {$this->name}Controller extends BaseController
{
    private \${$this->argument('name')}Service;

    public function __construct({$this->name}Service \${$this->argument('name')}Service)
    {
        \$this->{$this->argument('name')}Service = \${$this->argument('name')}Service;
    }
}

PHP;
    }

    public function getServiceStructure()
    {
             return <<<PHP
<?php

namespace Api\\{$this->name}s\Services;

use Api\\{$this->name}s\Repositories\\{$this->name}Repository;

class {$this->name}Service
{
    private \${$this->argument('name')}Repository;

    public function __construct({$this->name}Repository \${$this->argument('name')}Repository)
    {
        \$this->{$this->argument('name')}Repository = \${$this->argument('name')}Repository;
    }
}

PHP;
    }

    public function getModelStructure()
    {
                return <<<PHP
<?php

namespace Api\\{$this->name}s\Models;
use Illuminate\Database\Eloquent\Model;

class {$this->name} extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected \$fillable = [];

     /**
     *
     * @var string
     */
     protected \$table = '';
     /**
     *
     * @var array
     */
     protected \$appends = [];
}

PHP;

    }



    public function getRepositoryStructure()
    {
                return <<<PHP
<?php
namespace Api\\{$this->name}s\Repositories;
use Api\\{$this->name}s\Models\\$this->name;
class {$this->name}Repository
{
    public function getModel()
    {
        return new $this->name;
    }
}

PHP;

    }
}
