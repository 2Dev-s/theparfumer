<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected static ?string $heading = 'Latest Orders';

    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            // Query to get the latest orders
            ->query(Order::latest()) // Get the latest orders
            ->columns([
                // Define columns for the table
                TextColumn::make('user.name')
                    ->label('Client')
                    ->formatStateUsing(fn ($state) => $state),

                TextColumn::make('order_number')
                    ->label('Order Number')
                    ->formatStateUsing(fn ($state) => '#' . $state)
                    ->url(fn (Order $record) => route('filament.admin.resources.orders.edit', $record)),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => $state . ' RON'),

                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->getStateUsing(fn (Order $order) => $order->status) // Display status value
                    ->badge(fn (Order $order) => $this->getStatusLabel($order->status), fn (Order $order) => $this->getStatusColor($order->status)) // Badge with color
                    ->sortable(),

                TextColumn::make('created_at')->label('Created At'),

            ]);
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }

    /**
     * Get the status label based on order status.
     *
     * @param string $status
     * @return string
     */
    protected function getStatusLabel(string $status): string
    {
        switch ($status) {
            case 'pending':
                return 'Pending';
            case 'completed':
                return 'Completed';
            case 'cancelled':
                return 'Cancelled';
            default:
                return 'Unknown';
        }
    }

    /**
     * Get color based on order status.
     *
     * @param string $status
     * @return string
     */
    protected function getStatusColor(string $status): string
    {
        switch ($status) {
            case 'pending':
                return 'warning'; // Yellow
            case 'completed':
                return 'success'; // Green
            case 'cancelled':
                return 'danger'; // Red
            default:
                return 'secondary'; // Default color
        }
    }
}
