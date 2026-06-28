<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات المشروع')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('عنوان المشروع')
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

                        Select::make('service_id')
                            ->label('الخدمة المرتبطة')
                            ->relationship('service', 'title')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('client_name')
                            ->label('اسم العميل')
                            ->maxLength(255),

                        TextInput::make('category_label')
                            ->label('الشعار المعروض على الكارد')
                            ->required()
                            ->maxLength(255)
                            ->helperText('مثال: هوية بصرية كاملة'),

                        Textarea::make('short_description')
                            ->label('الوصف القصير')
                            ->required()
                            ->rows(2)
                            ->columnSpanFull(),

                        Textarea::make('full_description')
                            ->label('الوصف التفصيلي (لصفحة المشروع المستقلة)')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('الصور')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('cover_image')
                            ->label('صورة الغلاف')
                            ->image()
                            ->disk('public')
                            ->directory('projects/covers')
                            ->imageEditor()
                            ->visibility('public'),

                        FileUpload::make('gallery_images')
                            ->label('صور إضافية (معرض المشروع)')
                            ->image()
                            ->disk('public')
                            ->multiple()
                            ->reorderable()
                            ->directory('projects/gallery')
                            ->visibility('public'),

                        ColorPicker::make('accent_color')
                            ->label('لون بديل (لو لا توجد صورة)')
                            ->required()
                            ->default('#172E66'),
                    ]),

                Section::make('إعدادات العرض')
                    ->columns(3)
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_featured')
                            ->label('عرض بحجم مميز (كبير)')
                            ->default(false),

                        Toggle::make('is_published')
                            ->label('منشور')
                            ->default(true),
                    ]),
            ]);
    }
}