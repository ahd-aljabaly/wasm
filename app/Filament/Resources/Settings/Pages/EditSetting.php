<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['value'] = match ($data['type'] ?? 'text') {
            'text', 'url' => $data['value_text'] ?? null,
            'textarea' => $data['value_textarea'] ?? null,
            'image' => is_array($data['value_image'] ?? null) ? (reset($data['value_image']) ?: null) : ($data['value_image'] ?? null),
            'gallery' => is_array($data['value_gallery'] ?? null)
                ? json_encode(array_values(array_filter($data['value_gallery'])))
                : null,
            default => null,
        };

        unset(
            $data['value_text'],
            $data['value_textarea'],
            $data['value_image'],
            $data['value_gallery'],
        );

        return $data;
    }
}