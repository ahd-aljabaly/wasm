<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات الإعداد')
                    ->columns(2)
                    ->schema([
                        TextInput::make('key')
                            ->label('المفتاح')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabledOn('edit')
                            ->dehydrated()
                            ->helperText('معرّف برمجي بالإنجليزية فقط، بدون فراغات، مثال: tiktok_url')
                            ->rules(['regex:/^[a-z0-9_]+$/'])
                            ->validationMessages([
                                'regex' => 'المفتاح يقبل فقط حروف إنجليزية صغيرة وأرقام و _ بدون فراغات',
                            ]),

                        Select::make('group')
                            ->label('المجموعة')
                            ->required()
                            ->disabledOn('edit')
                            ->dehydrated()
                            ->options([
                                'general' => 'عام',
                                'hero' => 'الصفحة الرئيسية',
                                'contact' => 'التواصل',
                                'social' => 'السوشال ميديا',
                            ])
                            ->default('general'),

                        Select::make('type')
                            ->label('نوع القيمة')
                            ->required()
                            ->disabledOn('edit')
                            ->dehydrated()
                            ->live()
                            ->options([
                                'text' => 'نص قصير',
                                'textarea' => 'نص طويل',
                                'url' => 'رابط',
                                'image' => 'صورة فردية',
                                'gallery' => 'معرض صور متحرك',
                            ])
                            ->default('text')
                            ->columnSpanFull(),

                        TextInput::make('value_text')
                            ->label('القيمة')
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'url']))
                            ->afterStateHydrated(function (TextInput $component, $record) {
                                if ($record && in_array($record->type, ['text', 'url'])) {
                                    $component->state($record->value);
                                }
                            })
                            ->dehydrated(fn ($get) => in_array($get('type'), ['text', 'url']))
                            ->dehydrateStateUsing(fn ($state) => $state)
                            ->columnSpanFull(),

                        Textarea::make('value_textarea')
                            ->label('القيمة')
                            ->rows(4)
                            ->visible(fn ($get) => $get('type') === 'textarea')
                            ->afterStateHydrated(function (Textarea $component, $record) {
                                if ($record && $record->type === 'textarea') {
                                    $component->state($record->value);
                                }
                            })
                            ->dehydrated(fn ($get) => $get('type') === 'textarea')
                            ->dehydrateStateUsing(fn ($state) => $state)
                            ->columnSpanFull(),

                        FileUpload::make('value_image')
                            ->label('الصورة')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->afterStateHydrated(function (FileUpload $component, $record) {
                                if ($record && $record->type === 'image') {
                                    $component->state($record->value ? [$record->value] : []);
                                }
                            })
                            ->dehydrated(fn ($get) => $get('type') === 'image')
                            ->dehydrateStateUsing(fn ($state) => is_array($state) ? (reset($state) ?: null) : $state)
                            ->columnSpanFull(),

                        FileUpload::make('value_gallery')
                            ->label('صور المعرض المتحرك')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('settings/gallery')
                            ->visibility('public')
                            ->maxSize(10240)
                            ->helperText('يمكنك رفع عدة صور عصرية لأعمالكم لتتحرك تلقائياً في الواجهة.')
                            ->visible(fn ($get) => $get('type') === 'gallery')
                            ->afterStateHydrated(function (FileUpload $component, $record) {
                                if ($record && $record->type === 'gallery') {
                                    $value = $record->value;
                                    if (is_string($value) && !empty($value)) {
                                        $decoded = json_decode($value, true);
                                        $component->state(is_array($decoded) ? $decoded : []);
                                    } else {
                                        $component->state([]);
                                    }
                                }
                            })
                            ->dehydrated(fn ($get) => $get('type') === 'gallery')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }
}