<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

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
     * @return void
     */
    public function handle()
    {
        $serviceName = $this->argument('service');
        $this->line("Creating service {$serviceName} ...");
        if (!File::exists("app/Services"))
            File::makeDirectory("app/Services",0775,true);

        $schema = $this->schemaFileService($serviceName);
        File::put("app/Services/{$serviceName}.php",$schema);

        $this->info("The service with name {$serviceName} was created successfully");
    }

    /**
     * @param string $serviceName
     * @return string
     */
    private function schemaFileService(string $serviceName): string
    {
        $entityName = Str::of($serviceName)->replace("Service","");
        $service = Str::of($entityName)->replace("Api","");
        return
            '<?php namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\{Collection, Str};
use Illuminate\Http\{Response};
use App\Models\{NameModel};

class '.$serviceName.'
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Model|null
     * @throws \Exception
     */
    public function store()
    {
        DB::beginTransaction();
        try {
                $response = new NameModel([
                    "Attributes" => \request(""),
                ]);
        
                $response->save();
    
                DB::commit();
    
                return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return Model|null
     * @throws \Exception
     */
    public function update(string $id): ?Model
    {
        DB::beginTransaction();
        try {

            $response = NameModel::find($id)->update([
                "Attributes" => \request(""),
            ]);

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

}';
    }
}
