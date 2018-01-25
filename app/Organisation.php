<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['companyname'];

    protected $table="users";

    public function users()
    {
        return $this->hasMany('User', 'user_organisations', 'organisation_id', 'user_id');
    }

    public function branches()
    {
        return $this->hasMany('Branch');
    }
}
