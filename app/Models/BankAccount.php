<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'account_type',
        'account_creation_date',
       ];


    /**
     * Create a new bank account.
     *
     * @param array $data
     * @return BankAccount
     */
    public static function create(array $data): BankAccount
    {
        return static::query()->create($data);
    }
}
