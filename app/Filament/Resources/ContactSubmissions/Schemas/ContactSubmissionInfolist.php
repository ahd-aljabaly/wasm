<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات الطلب')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('الاسم'),

                        TextEntry::make('email')
                            ->label('البريد الإلكتروني')
                            ->copyable(),

                        TextEntry::make('phone')
                            ->label('الهاتف')
                            ->copyable(),

                        TextEntry::make('status')
                            ->label('الحالة')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'new' => 'جديد',
                                'contacted' => 'تم التواصل',
                                'in_progress' => 'قيد المعالجة',
                                'closed' => 'مغلق',
                                default => $state,
                            }),

                        TextEntry::make('message')
                            ->label('تفاصيل المشروع')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('تاريخ الطلب')
                            ->dateTime('Y-m-d H:i'),
                    ]),
            ]);
    }
}