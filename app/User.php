<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Please add this line
use Tymon\JWTAuth\Contracts\JWTSubject;

// Please implement JWTSubject interface
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'numero', 'password','activo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function examen(){
      return $this
          ->hasOne('App\Examen');
    }

    public function alumno(){
      return $this
          ->hasOne('App\Alumno');
    }


    public function role(){
     return $this->roles()->first()->name; 
    }

  public function roles()
  {
      return $this
          ->belongsToMany('App\Role')
          ->withTimestamps();
  }

  public function authorizeRoles($roles)
  {
      if ($this->hasAnyRole($roles)) {
          return true;
      }
      abort(401, 'Esta acción no está autorizada.');

  }

  public function hasAnyRole($roles)
  {
      if (is_array($roles)) {
          foreach ($roles as $role) {
              if ($this->hasRole($role)) {
                  return true;
              }
          }
      } else {
          if ($this->hasRole($roles)) {
              return true;
          }
      }
      return false;
  }

  public function hasRole($role)
  {
      if ($this->roles()->where('name', $role)->first()) {
          return true;
      }
      return false;
  }
  
  // Please ADD this two methods at the end of the class
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  public function getJWTCustomClaims()
  {
    return [];
  }
}
