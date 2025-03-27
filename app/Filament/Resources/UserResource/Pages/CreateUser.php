<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        // نحذف أي رول سابق (احتياط)
        $user->syncRoles([]);

        if ($user->role === 'admin') {
            $user->assignRole('admin');
        } elseif ($user->role === 'representative') {
            $user->assignRole('representative');
        }
    }
}
