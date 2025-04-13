<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\View\View;

class HomeController
{
    private object $User;
    public function __construct()
    {
        $this->User = new User();
    }
    public function create(): string
    {
        $userInfo = $this->User->findUserById($_SESSION['user_id']);
        $data = [
            'pageTitle' => 'Домашняя страница',
            'userInfo' => $userInfo
        ];
        return View::render('/home/index', $data);
    }
}