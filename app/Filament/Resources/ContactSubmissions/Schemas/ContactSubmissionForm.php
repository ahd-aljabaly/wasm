<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات الطلب')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->disabled(),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->disabled(),

                        TextInput::make('phone')
                            ->label('الهاتف')
                            ->disabled(),

                        Textarea::make('message')
                            ->label('تفاصيل المشروع')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('متابعة الطلب')
                    ->columns(1)
                    ->schema([
                        Select::make('status')
                            ->label('حالة الطلب')
                            ->options([
                                'new' => 'جديد',
                                'contacted' => 'تم التواصل',
                                'in_progress' => 'قيد المعالجة',
                                'closed' => 'مغلق',
                            ])
                            ->required(),
                    ]),
            ]);
    }
}