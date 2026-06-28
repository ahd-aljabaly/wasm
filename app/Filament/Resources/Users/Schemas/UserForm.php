<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات المستخدم والصلاحيات')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم الكامل')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('role')
                            ->label('الصلاحية / الرتبة')
                            ->required()
                            ->options([
                                'super_admin' => 'مدير فائق (كامل الصلاحيات)',
                                'admin'       => 'مدير نظام',
                                'editor'      => 'محرر محتوى',
                            ])
                            ->default('admin')
                            ->disabled(fn ($record) => $record && $record->isSuperAdmin() && auth()->user()->id !== $record->id)
                            ->dehydrated(),

                        TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->maxLength(255)
                            ->helperText(fn (string $operation): ?string => $operation === 'edit' ? 'اتركه فارغاً إذا كنت لا تريد تغيير كلمة المرور' : null),
                    ]),
            ]);
    }
}
