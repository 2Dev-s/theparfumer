<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CustomersChart extends ChartWidget
{
    protected static ?string $heading = 'New Customers per Month';
    protected static string $color = 'success';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // SQLite: folosește strftime pentru a extrage luna
        $newCustomersPerMonth = User::selectRaw("strftime('%m', created_at) as month, count(*) as total")
            ->whereRaw("strftime('%Y', created_at) = ?", [now()->year])
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Initialize data for 12 months
        $data = array_fill(1, 12, 0);

        // Map new customers per month to the data array
        foreach ($newCustomersPerMonth as $month => $count) {
            // Elimină zeroul din față (ex: '01' -> 1)
            $month = (int) $month;
            $data[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'New Customers',
                    'data' => array_values($data), // Returnează doar valorile
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
        return 'line';
    }
}
