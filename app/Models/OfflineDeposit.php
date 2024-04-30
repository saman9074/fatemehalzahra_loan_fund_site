<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineDeposit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'origin_card_number', 'destination_card_number', 'amount', 'deposit_time', 'tracking_number'];

    /**
     * @param array $validatedData
     * @return Builder|Model
     */
    public static function create(array $validatedData)
    {
        return static::query()->create($validatedData);
    }
}


