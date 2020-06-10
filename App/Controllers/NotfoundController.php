<?php

namespace Scooby\Controllers;

use Scooby\Core\Controller;
use Scooby\Helpers\HttpErrorResponse;
use Scooby\Helpers\Response;

class NotfoundController extends Controller
{
    /**
     * Metodo principal da classe
     *
     * @return void
     */
    public function index(): void
    {
        if (IS_API == 'true') {
            Response::Json([HttpErrorResponse::httpGetErrorCode() => HttpErrorResponse::httpGetErrorMsg()], (int) HttpErrorResponse::httpGetErrorCode());
        }
        $this->setTitle('Oppss - ' . HttpErrorResponse::httpGetErrorCode());
        $this->view('Error', '404', [
            'httpErrorCode' => HttpErrorResponse::httpGetErrorCode(),
            'httpErrorMessage' => HttpErrorResponse::httpGetErrorMsg(),
        ]);
    }
}
