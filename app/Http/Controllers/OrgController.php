<?php

namespace App\Http\Controllers;

use App\Organisation;
use Illuminate\Http\Request;


class OrgController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth',['except'=>['view']]);

    }

    public function findModel($id)
    {

        $model = Organisation::find($id);
        if (!$model) {
            $response = [
                'status' => 0,
                'errors' => "Invalid Record"
            ];

            response()->json($response, 400, [], JSON_PRETTY_PRINT)->send();
            die;
        }
        return $model;
    }

    public function add(Request $request)
    {

        $model = new Organisation();

        if (!empty($request->input('name')))
            $model->name = $request->input('name');

        $response = [
            'status' => 1,
        ];

        $model->save();

        $response['data'] = $model;

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

    public function update(Request $request, $id)
    {

        $model = $this->findModel($id);

        if (!empty($request->input('name')))
            $model->name = $request->input('name');

        $response = [
            'status' => 1,
        ];

        $model->save();

        $response['data'] = $model;

        return response()->json($response, 200, [], JSON_PRETTY_PRINT);
    }

}

?>