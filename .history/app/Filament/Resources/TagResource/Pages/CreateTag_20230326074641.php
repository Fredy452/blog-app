<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

     // Despues de crear el tag redirijimos al index
     protected function getRedirectUrl(): string
     {
         return $this->getResource()::getUrl('index');
     }
}
