<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                                'image' => 'صورة',
                                'video' => 'فيديو',
                            ])
                            ->default('text')
                            ->columnSpanFull(),

                        // كل حقل قيمة له اسم state مستقل (value_text, value_textarea...) بدل
                        // تشارك الأربعة بنفس اسم "value" - هذا كان سبب فضاء الفورم وقت Edit.
                        // afterStateHydrated بيقرأ القيمة الحقيقية من السجل عند فتح صفحة التعديل،
                        // dehydrateStateUsing بيحدد شو فعلياً يروح لعمود value وقت الحفظ.

                        TextInput::make('value_text')
                            ->label('القيمة')
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'url']))
                            ->afterStateHydrated(function (TextInput $component, $record) {
                                if ($record && in_array($record->type, ['text', 'url'])) {
                                    $component->state($record->value);
                                }
                            })
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
                            ->dehydrateStateUsing(fn ($state) => is_array($state) ? (reset($state) ?: null) : $state)
                            ->columnSpanFull(),

                        FileUpload::make('value_video')
                            ->label('الفيديو')
                            ->disk('public')
                            ->directory('settings/videos')
                            ->visibility('public')
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime'])
                            ->maxSize(51200)
                            ->helperText('الحد الأقصى لحجم الملف 50 ميجابايت. الصيغ المقبولة: MP4, WebM, MOV')
                            ->visible(fn ($get) => $get('type') === 'video')
                            ->afterStateHydrated(function (FileUpload $component, $record) {
                                if ($record && $record->type === 'video') {
                                    $component->state($record->value ? [$record->value] : []);
                                }
                            })
                            ->dehydrateStateUsing(fn ($state) => is_array($state) ? (reset($state) ?: null) : $state)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }
}
