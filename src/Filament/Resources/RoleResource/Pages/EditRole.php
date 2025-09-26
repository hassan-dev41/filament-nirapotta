<?php

namespace HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages;

use HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}