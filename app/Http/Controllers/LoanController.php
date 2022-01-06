<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Loan;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class LoanController extends Controller
{
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $loan = Loan::all();

        return view('loan.index', compact('loan'));
    }

    public function create(){
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('loan.create');
    }

    public function store(Request $request){
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
//        print_r($request->all());
        Loan::create([
            'loan_type' => $request->loan_type,
            'life' => $request->life,
            'annual_rate' => $request->annual_rate,
            'rate' => $request->rate,
            'status' => $request->status,
        ]);
        Toastr::success('created successfully.', 'success', ["positionClass" => "toast-top-right"]);
//        return view('branch.index', compact('branch'));
        return redirect('admin/loan');
    }

    public function show($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $branch = DB::select("select * from branches where id = ".$id);
        $states = DB::select('select * from states');
        $cities = DB::select('select * from cities');
        return view('branch.show', compact('branch','states', 'cities'));
    }
}
