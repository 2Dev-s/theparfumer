<?php

namespace App\Filament\Resources\RoomPerfumeResource\Pages;

use App\Filament\Resources\RoomPerfumeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomPerfumes extends ListRecords
{
    protected static string $resource = RoomPerfumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
