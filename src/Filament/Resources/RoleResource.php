<?php

namespace HassanDev41\FilamentNirapotta\Filament\Resources;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use HassanDev41\FilamentNirapotta\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?int $navigationSort = 2;

    /**
     * Get the navigation icon for this resource.
     */
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-shield-check';
    }

    /**
     * Get the navigation group for this resource.
     */
    public static function getNavigationGroup(): ?string
    {
        return config('filament-nirapotta.navigation_group', 'User Management');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\CheckboxList::make('permissions')
                            ->relationship('permissions', 'name')
                            ->searchable()
                            ->columns(3)
                            ->helperText('Select the permissions for this role')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages\ListRoles::class,
            'create' => \HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages\CreateRole::class,
            'edit' => \HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource\Pages\EditRole::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('guard_name', config('filament-nirapotta.guard_name'));
    }
}