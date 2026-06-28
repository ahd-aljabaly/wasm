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
                                'video' => 'فيديو', // خيار الفيديو المضاف حديثاً
                            ])
                            ->default('text')
                            ->columnSpanFull(),

                        TextInput::make('value')
                            ->label('القيمة')
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'url']))
                            ->columnSpanFull(),

                        Textarea::make('value')
                            ->label('القيمة')
                            ->rows(4)
                            ->visible(fn ($get) => $get('type') === 'textarea')
                            ->columnSpanFull(),

                        FileUpload::make('value')
                            ->label('الصورة')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->columnSpanFull(),

                        // حقل الفيديو المضاف حديثاً متوافق مع نفس الأسلوب
                        FileUpload::make('value')
                            ->label('الفيديو')
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->visible(fn ($get) => $get('get') === 'video' || $get('type') === 'video')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}