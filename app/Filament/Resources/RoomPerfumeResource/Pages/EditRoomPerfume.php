<?php

namespace App\Filament\Resources\RoomPerfumeResource\Pages;

use App\Filament\Resources\RoomPerfumeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomPerfume extends EditRecord
{
    protected static string $resource = RoomPerfumeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
