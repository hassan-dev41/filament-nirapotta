<?php

namespace HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages;

use HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}