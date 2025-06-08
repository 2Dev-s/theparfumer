<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class CustomersChart extends ChartWidget
{
    protected static ?string $heading = 'New Customers per Month';
    protected static string $color = 'success';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Get the number of new customers created each month in the current year
        $newCustomersPerMonth = User::selectRaw('MONTH(created_at) as month, count(*) as total')
            ->whereYear('created_at', now()->year) // Filter by current year
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Initialize data for 12 months
        $data = array_fill(1, 12, 0);

        // Map new customers per month to the data array
        foreach ($newCustomersPerMonth as $month => $count) {
            $data[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Customers',
                    'data' => $data, // This will display new customers data per month
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
