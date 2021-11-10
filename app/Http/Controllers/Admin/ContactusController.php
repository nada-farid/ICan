<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactuRequest;
use App\Models\Contactu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
Use Alert;

class ContactusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('contactu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Contactu::query()->select(sprintf('%s.*', (new Contactu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'contactu_show';
                $editGate = 'contactu_edit';
                $deleteGate = 'contactu_delete';
                $crudRoutePart = 'contactus';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.contactus.index');
    }

    public function destroy(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactu->delete();
        
        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyContactuRequest $request)
    {
        Contactu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
