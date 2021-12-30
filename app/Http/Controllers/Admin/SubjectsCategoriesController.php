<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubjectsCategoryRequest;
use App\Http\Requests\StoreSubjectsCategoryRequest;
use App\Http\Requests\UpdateSubjectsCategoryRequest;
use App\Models\SubjectsCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubjectsCategoriesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('subjects_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjectsCategories = SubjectsCategory::all();

        return view('admin.subjectsCategories.index', compact('subjectsCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('subjects_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subjectsCategories.create');
    }

    public function store(StoreSubjectsCategoryRequest $request)
    {
        $subjectsCategory = SubjectsCategory::create($request->all());

        return redirect()->route('admin.subjects-categories.index');
    }

    public function edit(SubjectsCategory $subjectsCategory)
    {
        abort_if(Gate::denies('subjects_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subjectsCategories.edit', compact('subjectsCategory'));
    }

    public function update(UpdateSubjectsCategoryRequest $request, SubjectsCategory $subjectsCategory)
    {
        $subjectsCategory->update($request->all());

        return redirect()->route('admin.subjects-categories.index');
    }

    public function show(SubjectsCategory $subjectsCategory)
    {
        abort_if(Gate::denies('subjects_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjectsCategory->load('subjectCategoryPublicSubjects');

        return view('admin.subjectsCategories.show', compact('subjectsCategory'));
    }

    public function destroy(SubjectsCategory $subjectsCategory)
    {
        abort_if(Gate::denies('subjects_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subjectsCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySubjectsCategoryRequest $request)
    {
        SubjectsCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
