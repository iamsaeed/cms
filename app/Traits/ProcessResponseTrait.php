<?php

namespace App\Traits;

trait ProcessResponseTrait
{
    public function processResponse($data, $status, $message = null){
        if($status == 'success') {
            // process for error
            return response()->json([
                'status' => 'success',
                'categories' => $data,
                'code' => 200,
                'message' => $message
            ]);
        } else {
            // process for error
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => $message
            ]);
        }
    }
}
