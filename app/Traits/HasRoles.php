<?php
namespace App\Traits;

use App\Role;

/**
 * HasRoles
 */
trait HasRoles
{
  public function assignRole($role)
  {
    return $this->roles()->save(
      Role::whereSlug($role)->firstOrFail()
    );
  }

  public function hasRole($role)
  {
    if (is_string($role)) {
      return $this->roles->contains('slug', $role);
    }
    return !!$role->intersect($this->roles)->count();
  }

  public function roles()
  {
    return $this->belongsToMany('App\Role');
  }
}
