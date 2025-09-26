<?php

namespace Frentors\FilamentNirapotta\Filament\Resources\RoleResource\Pages;

use Frentors\FilamentNirapotta\Filament\Resources\RoleResource;
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