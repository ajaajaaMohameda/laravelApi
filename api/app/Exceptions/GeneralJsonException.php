<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    //

    protected $code =422;
    
    public function render($request)
    {
        return new JsonResponse([
            'errors' => $this->getMessage()
        ], $this->getCode());
    }
}
