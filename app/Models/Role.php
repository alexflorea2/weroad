<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends UuidModel
{
    final public const ROLE_ADMIN = "admin";
    final public const ROLE_EDITOR = "editor";
    public function users()
    {
        return $this->hasMany(User::class, 'roleId');
    }
}
