<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProblemRequest;
use App\Models\Problem;

class ProblemsController extends Controller
{
    //
    public function store(StoreProblemRequest $request)
    {
        $problem = Problem::create($request->all());

        return redirect('/');
    }
}
