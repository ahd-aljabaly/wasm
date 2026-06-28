<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات الخدمة')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان الخدمة')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('المعرّف (slug)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('يتولد تلقائياً من العنوان، غير قابل للتعديل اليدوي'),

                        TextInput::make('icon')
                            ->label('اسم الأيقونة')
                            ->maxLength(255)
                            ->helperText('اسم أيقونة Material Symbols، مثال: brush'),

                        Textarea::make('description')
                            ->label('الوصف')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('badge')
                            ->label('شعار مميز (اختياري)')
                            ->maxLength(255)
                            ->helperText('مثال: الأكثر طلباً - اتركه فاضي لعدم الإظهار'),

                        TextInput::make('cta_text')
                            ->label('نص رابط التفاصيل')
                            ->maxLength(255),
                    ]),

                Section::make('إعدادات العرض')
                    ->columns(3)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->required()
                            ->default(0),

                        Toggle::make('is_featured')
                            ->label('عرض بحجم مميز (كبير)')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('مفعّلة')
                            ->default(true),
                    ]),
            ]);
    }
}