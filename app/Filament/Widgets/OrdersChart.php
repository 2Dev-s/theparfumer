<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

// Make sure to use your Order model

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders per Month';
    protected static string $color = 'info';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Get the number of orders created each month in the current year
        $ordersPerMonth = Order::selectRaw('MONTH(created_at) as month, count(*) as total')
            ->whereYear('created_at', now()->year) // Filter by current year
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Initialize data for 12 months
        $data = array_fill(1, 12, 0);

        // Map orders per month to the data array
        foreach ($ordersPerMonth as $month => $count) {
            $data[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Orders created',
                    'data' => $data, // This will display orders data per month
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    'fill' => false,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Use line chart
    }
}
