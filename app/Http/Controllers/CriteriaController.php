<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index(){
        return view("pages.criteria.index",
        [
            'data' => Criteria::all(),
            "title" => "Criteria"
        ]);
    }

    public function store(Request $request){    
        Criteria::create([
            'name' => $request->criteria,
        ]);
        return redirect()->back()->with(['success' => 'Data Bahan Baku Telah Ditambahkan']);
    }
}
