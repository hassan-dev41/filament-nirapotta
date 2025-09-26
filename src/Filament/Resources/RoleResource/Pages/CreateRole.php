<?php

namespace HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages;

use HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['guard_name'] = config('filament-nirapotta.guard_name');

        return $data;
    }
}