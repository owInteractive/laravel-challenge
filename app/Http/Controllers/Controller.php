<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tryCatch($callback, FormRequest $instanceRequestValidator = null)
    {
        try {

            if ($instanceRequestValidator instanceof FormRequest) {

                $validate = \Validator::make(request()->all(), $instanceRequestValidator->rules(), $instanceRequestValidator->messages());

                if ($validate->fails()) return response()->json($validate->errors(), 400);
            }

            return response()->json($callback());

        } catch (\Exception $ex) {

            return response()->json(['error' => $ex->getMessage(), 'details' => $ex->getTrace()], 500);
        }
    }
}
