<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\HasCurrentTenantLabel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model implements HasCurrentTenantLabel
{
    use HasFactory;
    use Billable;

    protected $fillable = [
        'name',
        'asaas_customer_id',
        'document_number',
        'email',
        'slug',
        'phone',
        'is_active',
        'expires_at'

    ];

    public function getCurrentTenantLabel(): string
    {
        return 'Minha Empresa';
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
}
