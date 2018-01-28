<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;


class BranchController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth',['except'=>['view']]);

    }

}

?>