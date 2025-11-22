<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingFooterLink extends Model
{
    protected $table = 'landing-footer_links';

    protected $fillable = [
        'label', 
        'url',
        'group',
        'position',
        'status',
    ];

    protected $casts = [
        'position' => 'integer',
        'status' => 'boolean',
    ];

    public function scopeActive($q) { return $q->where('status', true); }
    public function scopeordered($q) { return $q->orderBy('position'); }
}
