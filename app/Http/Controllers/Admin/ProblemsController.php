<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProblemRequest;
use App\Http\Requests\StoreProblemRequest;
use App\Http\Requests\UpdateProblemRequest;
use App\Models\Problem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
Use Alert;

class ProblemsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('problem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $problems = Problem::all();

        return view('admin.problems.index', compact('problems'));
    }

    public function create()
    {
        abort_if(Gate::denies('problem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.problems.create');
    }

    public function store(StoreProblemRequest $request)
    {
        $problem = Problem::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.problems.index');
    }

    public function edit(Problem $problem)
    {
        abort_if(Gate::denies('problem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.problems.edit', compact('problem'));
    }

    public function update(UpdateProblemRequest $request, Problem $problem)
    {
        $problem->update($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.problems.index');
    }

    public function show(Problem $problem)
    {
        abort_if(Gate::denies('problem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.problems.show', compact('problem'));
    }

    public function destroy(Problem $problem)
    {
        abort_if(Gate::denies('problem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $problem->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));
        
        return back();
    }

    public function massDestroy(MassDestroyProblemRequest $request)
    {
        Problem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
