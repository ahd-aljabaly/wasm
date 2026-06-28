<?php

namespace App\Filament\Resources\ProcessSteps\Pages;

use App\Filament\Resources\ProcessSteps\ProcessStepResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProcessStep extends ViewRecord
{
    protected static string $resource = ProcessStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
