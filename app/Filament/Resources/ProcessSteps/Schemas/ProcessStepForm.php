<?php

namespace App\Filament\Resources\ProcessSteps\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProcessStepForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('step_number')
                    ->label('رقم الخطوة')
                    ->numeric()
                    ->required(),

                TextInput::make('title')
                    ->label('عنوان الخطوة')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('الوصف')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

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