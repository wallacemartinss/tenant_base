<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Cashier\Billable;
use Illuminate\Support\Collection;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasTenants;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements HasTenants, Sortable, HasAvatar

{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SortableTrait;



    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    protected $fillable = [
    
        'name',
        'avatar_url',
        'settings',
        'is_admin',
        'email',
        'phone',
        'password',
        'is_active',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'settings' => 'array',
        ];
    }

 
    public function organization(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }
        
    public function getTenants(Panel $panel): Collection
    {
        return $this->organization;
    }
 
    public function canAccessTenant(Model $organization): bool
    {
        return $this->organization()->whereKey($organization)->exists();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
        
    }

  
}
