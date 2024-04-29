<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['bank_account_id', 'amount', 'transaction_type'];

    /**
     * @param array $validatedData
     * @return void
     */
    public static function create(array $validatedData)
    {
        return static::query()->create($validatedData);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
