<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class GeneralChars extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalSales = $this->getFormattedTotalSales();
        $totalSalesColor = $this->getColorBasedOnComparison($this->getPreviousTotalSales(), $totalSales);

        $customersCount = $this->getCustomersCount();
        $customersColor = $this->getColorBasedOnComparison($this->getPreviousCustomersCount(), $customersCount);

        $newCustomersCount = $this->getNewCustomersCount();
        $newCustomersColor = $this->getColorBasedOnComparison($this->getPreviousNewCustomersCount(), $newCustomersCount);

        return [
            Stat::make('Total Sales in the Last 30 Days', $totalSales)
                ->description('Total sales revenue in the last 30 days (RON)')
                ->chart($this->getSalesChartData())
                ->color($totalSalesColor),

            Stat::make('Users in the Last 30 Days', $customersCount . ' Users')
                ->description('Total users who made at least one order in the last 30 days')
                ->chart($this->getCustomersChartData())
                ->color($customersColor),

            Stat::make('Customers in the Last 30 Days', $newCustomersCount . ' Customers')
                ->description('Total new users who made at least one order in the last 30 days')
                ->chart($this->getNewCustomersChartData())
                ->color($newCustomersColor),
        ];
    }

    private function getNewCustomersCount(): int
    {
        return Order::where('created_at', '>=', now()->subDays(30))
            ->whereHas('user', function ($query) {
                $query->where('created_at', '>=', now()->subDays(30));
            })
            ->distinct('user_id')
            ->count('user_id');
    }

    private function getCustomersCount(): int
    {
        return Order::where('created_at', '>=', now()->subDays(30))
            ->distinct('user_id')
            ->count('user_id');
    }

    private function getTotalSales(): float
    {
        return Order::where('created_at', '>=', now()->subDays(30))
            ->where('status', 'completed')  // add this
            ->sum('total_amount');
    }

    private function getSalesChartData(): array
    {
        $data = [];

        foreach (range(29, 0) as $i) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $dailySales = Order::whereDate('created_at', $day)
                ->where('status', 'completed')  // add this
                ->sum('total_amount');
            $data[] = $dailySales;
        }

        return $data;
    }


    private function getFormattedTotalSales(): string
    {
        $totalSales = $this->getTotalSales();
        return number_format($totalSales, 2, '.', ',') . ' RON';
    }

    private function getUsersChartData(): array
    {
        $data = [];

        foreach (range(29, 0) as $i) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $userCount = User::whereDate('created_at', $day)->count();
            $data[] = $userCount;
        }

        return $data;
    }

    private function getCustomersChartData(): array
    {
        $data = [];

        foreach (range(29, 0) as $i) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $customerCount = Order::whereDate('created_at', $day)
                ->distinct('user_id')
                ->count('user_id');
            $data[] = $customerCount;
        }

        return $data;
    }

    private function getNewCustomersChartData(): array
    {
        $data = [];

        foreach (range(29, 0) as $i) {
            $day = Carbon::now()->subDays($i)->startOfDay();
            $newCustomerCount = Order::whereDate('created_at', $day)
                ->whereHas('user', function ($query) use ($day) {
                    $query->whereDate('created_at', '>=', $day);
                })
                ->distinct('user_id')
                ->count('user_id');
            $data[] = $newCustomerCount;
        }

        return $data;
    }

    private function getColorBasedOnComparison($previousValue, $currentValue): string
    {
        if ($currentValue > $previousValue) {
            return 'success'; // Green
        } elseif ($currentValue < $previousValue) {
            return 'danger'; // Red
        } else {
            return 'warning'; // Yellow
        }
    }

    private function getPreviousTotalSales(): float
    {
        return Order::where('created_at', '>=', now()->subDays(60))
            ->where('status', 'completed')
            ->sum('total_amount');
    }

    private function getPreviousCustomersCount(): int
    {
        return Order::where('created_at', '>=', now()->subDays(60))
            ->distinct('user_id')
            ->count('user_id');
    }

    private function getPreviousNewCustomersCount(): int
    {
        return Order::where('created_at', '>=', now()->subDays(60))
            ->whereHas('user', function ($query) {
                $query->where('created_at', '>=', now()->subDays(60));
            })
            ->distinct('user_id')
            ->count('user_id');
    }
}
