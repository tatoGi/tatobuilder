<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'data',
        'form_id',
        'validation'
    ];

    protected $casts = [
        'data' => 'json',
        'validation' => 'json'
    ];

    /**
     * Get the form that owns the FormField
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(form::class, 'id', 'form_id');
    }
}
