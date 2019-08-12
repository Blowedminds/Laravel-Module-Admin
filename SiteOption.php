<?php

namespace App\Modules\Admin;

use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
    protected $fillable = [
        'key', 'type', 'value'
    ];
}
