<?php

namespace App\Http\Controllers;

use App\Services\StatisticService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(StatisticService $statisticService): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view(
            'index',
            [
                'hotelsWithSmallestStaysNumbers' => $statisticService->getHotelsWithSmallestStaysNumbers(5),
                'averageRejectionRate'           => $statisticService->getAverageRejectionRate(),
                'unluckyCustomers'               => $statisticService->getUnluckyCustomers(5),
            ]
        );
    }
}
