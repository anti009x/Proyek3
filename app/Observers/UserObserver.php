<?php

namespace App\Observers;

use App\Models\Kurir;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role_id === 3) {
            Kurir::create([
                'role_id' => $user->role_id,
                'nama' => $user->nama,
                'nohp' => $user->nohp,
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->role_id === 3) {
            Kurir::updateOrCreate(
                ['nama' => $user->nama],
                [
                    'role_id' => $user->role_id,
                    'nohp' => $user->nohp,
                ]
            );
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
