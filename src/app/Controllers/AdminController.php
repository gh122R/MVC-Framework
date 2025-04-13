<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\View\View;

class AdminController
{
    private object $User;

    public function __construct()
    {
        $this->User = new User();
    }

    public function index(): string
    {
        $userInfo = $this->User->findUserById($_SESSION['user_id']);
        $data = [
            'pageTitle' => 'админ-панель',
            'userInfo' => $userInfo
        ];
        return View::render('admin-panel/index', $data);
    }
}