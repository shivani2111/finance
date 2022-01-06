<?php

namespace App\Http\Controllers;

use App\Branch;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BranchController extends Controller
{
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $branch = Branch::all();

        return view('branch.index', compact('branch'));
    }

    public function create(){
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $states = DB::select("select * from states where status = 0");
        $cities = DB::select("select * from cities where status = 0");
        return view('branch.create',compact('states','cities'));
    }

    public function getcity($id){
        $cites = DB::select("select id, name from cities where state_id = ".$id);
//        print_r($cites);exit();
        return json_encode($cites);
    }

    public function store(Request $request){
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
//        print_r($request->all());
        Branch::create([
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'branch_address' => $request->branch_address,
            'branch_postal_code' => $request->branch_postal_code,
            'state_id' => $request->branch_state_id,
            'city_id' => $request->branch_city_id,
            'status' => $request->branch_status,
        ]);
        Toastr::success('created successfully.', 'success', ["positionClass" => "toast-top-right"]);
//        return view('branch.index', compact('branch'));
        return redirect('admin/branch');
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
