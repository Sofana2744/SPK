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
    public function store(Request $request)
    {
        Criteria::create([
            'name' => $request->criteria,
        ]);

        return redirect()->back()->with(['success' => 'data criteria berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        Criteria::find($id)->delete();

        return back()->with(['delete' => 'Data criteria berhasil hapus']);

    }

    public function update(Request $request, $id)
    {
        $criteria = Criteria::find($id);
        $criteria->update([
            'name' => $request->criteria, 
        ]);

        return redirect()->back()->with(['update' => 'Data criteria berhasil diupdate']);

    }
}
