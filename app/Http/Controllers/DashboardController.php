<?php

namespace App\Http\Controllers;

use App\Services\AdafruitService;

class DashboardController extends Controller
{
    protected $adafruitService;

    public function __construct(AdafruitService $adafruitService)
    {
        $this->adafruitService = $adafruitService;
    }

    public function index()
    {
        $username = 'MikeTyto'; // Укажите ваше имя пользователя Adafruit IO
        $feedName = 'weight'; // Укажите имя вашего фида

        $feedData = $this->adafruitService->getFeedData($username, $feedName);

        return view('dashboard', ['feedData' => $feedData]);
    }
}
