<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Update_Mobile_Verify
{

    /**
     * @param User $user
     * @param array $input
     * @return void
     */
    public function updateMVA(User $user): void
    {
        $user->forceFill([
            'mobile_verified_at' => Carbon::now()->timestamp
        ])->save();
    }
}
