<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
  protected $table= 'users_roles';
  protected $fillable = [
    'user_id', 'role_id',
  ];
  public function role()
  {
    return $this->hasOne('App\Roles','id','role_id');
  }
}
