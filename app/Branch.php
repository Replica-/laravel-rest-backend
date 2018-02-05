<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

Use App\Organisation;

class Branch extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['name'];
    protected $table="branches";

    public function organisation() {
        return $this->belongsTo('App\Organisation', 'organisationId');
    }

    public function user()
    {
        return $this->hasMany('User', 'user_branches', 'branch_id', 'user_id');
    }
}
