<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['value'] = match ($data['type'] ?? 'text') {
            'text', 'url' => $data['value_text'] ?? null,
            'textarea' => $data['value_textarea'] ?? null,
            'image' => is_array($data['value_image'] ?? null) ? (reset($data['value_image']) ?: null) : ($data['value_image'] ?? null),
            'video' => is_array($data['value_video'] ?? null) ? (reset($data['value_video']) ?: null) : ($data['value_video'] ?? null),
            default => null,
        };

        unset($data['value_text'], $data['value_textarea'], $data['value_image'], $data['value_video']);

        return $data;
    }
}
