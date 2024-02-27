<?php

namespace App\Models;

class Role extends UuidModel
{
    final public const ROLE_ADMIN = 'admin';

    final public const ROLE_EDITOR = 'editor';

    public function users()
    {
        return $this->hasMany(User::class, 'roleId');
    }
}
