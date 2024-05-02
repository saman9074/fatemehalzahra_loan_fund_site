<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class LoanRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'income_variety', 'job_type', 'job_title', 'second_job', 'main_income', 'other_income', 'monthly_expenses', 'salary_slip', 'bank_statement', 'assets', 'loan_amount', 'installments', 'reason', 'guarantor_name', 'guarantor_national_code', 'guarantor_birth_date', 'guarantor_has_check'];

    public static function create(array $validatedData): Model|Builder
    {
        // Handle file uploads
        if (isset($validatedData['salary_slip']) && $validatedData['salary_slip'] instanceof UploadedFile) {
            $validatedData['salary_slip'] = Storage::url($validatedData['salary_slip']);
        }

        if (isset($validatedData['bank_statement']) && $validatedData['bank_statement'] instanceof UploadedFile) {
            $validatedData['bank_statement'] = Storage::url($validatedData['bank_statement']);
        }

        return static::query()->create($validatedData);
    }
}
