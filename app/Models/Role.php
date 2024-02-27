<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends UuidModel
{
    final public const ROLE_ADMIN = 'admin';

    final public const ROLE_EDITOR = 'editor';

    /**
     * @return HasMany<User>
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'roleId');
    }
}
