<?php

namespace App\Controllers;

class ErrorController extends CoreController
{
    public function error403()
    {
        header('HTTP/1.0 403 Forbidden');
        $this->show('error/error_403');
    }

    public function error404()
    {
        header('HTTP/1.0 404 Not Found');
        $this->show('error/error_404');
    }
}