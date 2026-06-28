<?php

namespace App\Filament\Resources\Stats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('icon')
                    ->label('اسم الأيقونة')
                    ->helperText('مثال: groups, task_alt, timeline, support_agent'),

                TextInput::make('value')
                    ->label('القيمة المعروضة')
                    ->required()
                    ->helperText('مثال: 120+ أو 24h'),

                TextInput::make('label')
                    ->label('الوصف تحت الرقم')
                    ->required(),

                TextInput::make('sort_order')
                    ->label('الترتيب')
                    ->numeric()
                    ->required()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('مفعّلة')
                    ->default(true),
            ])
            ->columns(2);
    }
}