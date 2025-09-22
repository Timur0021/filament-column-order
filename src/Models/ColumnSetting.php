<?php

namespace Vendor\FilamentColumnOrder\Models;

use Illuminate\Database\Eloquent\Model;

class ColumnSetting extends Model
{
    protected $table = 'column_settings';

    protected $fillable = [
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];
}