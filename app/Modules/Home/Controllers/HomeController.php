<?php

declare(strict_types=1);

namespace App\Modules\Home\Controllers;

use App\Core\Controller\BaseController;
use App\Core\Logging\Logger;

final class HomeController extends BaseController
{
    public function index(): void
    {
        Logger::info('HomeController@index');

        $this->view(
            'Modules/Home/Views/index',
            [
                'title' => 'Transport ERP Platform v3'
            ]
        );
    }
}
