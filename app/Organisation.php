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

    protected $table="organisations";

    public function users()
    {
        return $this->hasMany('App\User', 'user_organisations', 'organisation_id', 'user_id');
    }

    public function branches()
    {
        return $this->hasMany('App\Branch', 'organisationId');
    }


}
