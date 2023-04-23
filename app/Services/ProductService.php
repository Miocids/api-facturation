<?php namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\{Collection, Str};
use Illuminate\Http\{Response};
use App\Models\{Product};

class ProductService
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
                $response = new Product([
                    "user_id"       => \auth()->user()->getKey(),
                    "product"       => \request("product"),
                    "price"         => \request("price"),
                    "description"   => \request("description"),
                    "image_url"     => "",
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

}