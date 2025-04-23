<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'type',
        'name',
        'label',
        'placeholder',
        'required',
        'validation_rules',
        'order',
        'options',
    ];

    protected $casts = [
        'required' => 'boolean',
        'validation_rules' => 'array',
        'options' => 'array',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
