<?php

namespace Tima\FilamentColumnOrder\Models;

use Illuminate\Database\Eloquent\Model;

class ColumnSetting extends Model
{
    protected $table = 'setting_columns';

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}