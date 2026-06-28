<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->label('المجموعة')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => 'عام',
                        'hero' => 'الصفحة الرئيسية',
                        'contact' => 'التواصل',
                        'social' => 'السوشال ميديا',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'gray',
                        'hero' => 'info',
                        'contact' => 'success',
                        'social' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('key')
                    ->label('المفتاح')
                    ->searchable(),

                TextColumn::make('value')
                    ->label('القيمة الحالية')
                    ->limit(50)
                    ->placeholder('—'),

                TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultSort('group')
            ->filters([
                SelectFilter::make('group')
                    ->label('المجموعة')
                    ->options([
                        'general' => 'عام',
                        'hero' => 'الصفحة الرئيسية',
                        'contact' => 'التواصل',
                        'social' => 'السوشال ميديا',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('تأكيد الحذف')
                    ->modalSubheading('هل أنت متأكد أنك تريد حذف هذا الإعداد؟ لا يمكن التراجع عن هذا الإجراء.')
                    ->modalButton('حذف')
                    ->color('danger'),
            ]);
    }
}
