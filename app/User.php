<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Support\Facades\Hash;

Use App\Branch;
Use App\Organisation;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasRoles;
    protected $guard_name = 'api'; // or whatever guard you want to use
    protected $table="users";

    static public function rules($id=NULL)
    {
        return [
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ];
    }
    static public function updateRules($id=NULL)
    {
        return [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
        ];
    }
    static public function authorizeRules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }
    static public function accessTokenRules()
    {
        return [
            'authorization_code' => 'required',
        ];
    }

    public function branches()
    {
        return $this->belongsToMany('App\Branch', 'user_branches', 'user_id','branch_id')->With('organisation');
    }

    public function getAllOrganisations()
    {
        $organisations = [];

        foreach ($this->organisations as $org) {
            $organisations[] = $org;
        }

        return $organisations;
    }

    public function getAllBranches()
    {
        $orgReturn = [];

        foreach ($this->organisations as $org) {
                $orgReturn[] = $org;
        }

        foreach ($this->branches as $branch) {
            $key = $branch->organisation->id;
            $newOrg = $branch->organisation;
            unset($branch["organisation"]);
            $newOrg["branches"][] = $branch;
            $orgReturn[] = $newOrg;
        }

        return $orgReturn;
    }

    public function organisations()
    {
        return $this->belongsToMany('App\Organisation', 'user_organisations', 'user_id', 'organisation_id')->With('branches');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email','password','name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'password_reset_token'
    ];
    static public function search($request)
    {

        $page = $request->input('page');
        $limit = $request->input('limit');
        $order = $request->input('order');

        $search = $request->input('search');

        if(isset($search)){
            $params=$search;
        }

        $limit = isset($limit) ? $limit : 10;
        $page = isset($page) ? $page : 1;


        $offset = ($page - 1) * $limit;

        $query = User::select(['id', 'username', 'email', 'created_at', 'updated_at'])
            ->limit($limit)
            ->offset($offset);

        if(isset($params['id'])) {
            $query->where(['id' => $params['id']]);
        }

        if(isset($params['created_at'])) {
            $query->where(['created_at' => $params['created_at']]);
        }
        if(isset($params['updated_at'])) {
            $query->where(['updated_at' => $params['updated_at']]);
        }
        if(isset($params['username'])) {
            $query->where('username','like',$params['username']);
        }
        if(isset($params['email'])){
            $query->where('email','like',$params['email']);
        }


        if(isset($order)){
            $query->orderBy($order);
        }

        $data=$query->get();


        return [
            'status'=>1,
            'data' => $data,
            'page' => (int)$page,
            'size' => $limit,
            'totalCount' => (int)$data->count()
        ];
    }



    public static function authorize($attributes){

        $model=User::where(['username'=>$attributes['username']])->select(['id','username','password'])->first();
        if(!$model)
            return false;


        if(Hash::check($attributes['password'],$model->password)) {
            return $model;
            // Right password
        } else {
            // Wrong one
        }



        return false;
    }

    /*
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $access_token = AccessTokens::findOne(['token' => $token]);
        if ($access_token) {
            if ($access_token->expires_at < time()) {
                Yii::$app->api->sendFailedResponse('Access token expired');
            }

            return static::findOne(['id' => $access_token->user_id]);
        } else {
            return (false);
        }
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    */
}
