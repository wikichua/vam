<?php

namespace Wikichua\VAM\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;

    // roles relationship
    public function roles()
    {
        return $this->belongsToMany(config('vam.models.role'));
    }

    // users relationship
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'));
    }

    // create permission group
    public function createGroup($group, $names = [])
    {
        foreach ($names as $name) {
            $this->create([
                'group' => $group,
                'name' => $name,
            ]);
        }
    }
}
