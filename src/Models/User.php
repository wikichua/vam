<?php

namespace Wikichua\VAM\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    use \Wikichua\VAM\Http\Traits\AdminUser;
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;

    public function scopeFilterName($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
    public function scopeFilterEmail($query, $search)
    {
        return $query->where('email', 'like', "%{$search}%");
    }
}
