<?php namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\{Collection, Str};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\{JsonResponse, Response};
use App\Models\User;

class UserService
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
        $user = new User([
            "name" => \request("name"),
            "email" => \request("email"),
            "password" => \bcrypt(\request("password")),
            "remember_token" => Str::random(10)
        ]);

        $user->save();

            DB::commit();

            return $user;

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
    public function update(string $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id)->update([
                "email" => \request("email"),
                "password" => \bcrypt(\request("password")),
            ]);

            DB::commit();

            return $user;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

}