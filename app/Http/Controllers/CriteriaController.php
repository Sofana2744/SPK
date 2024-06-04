<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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

    public function matrix(Request $request)
    {
        $criteria = Criteria::all();
        
        return view('pages.matrix.index', [
            'criteria' => $criteria,
            'title' => 'Matrix Kriteria',
        ]);
    }

    public function prosesMatrix(Request $request) 
    {
    $criteria = Criteria::all();
    $data = array();
    $i = 0;
        foreach ($criteria as $row) {
            $t=0;
            foreach($criteria as $item) {
                $push = str_replace(' ','', $row->name.'_'.$item->name);
                if ($request->$push == null){
                    $data[$i][$t] = 1;
                    $t++;
                }
                else{
                                    $data[$i][$t] = (float)$request->$push;
                $t++;
                }

            }
            $i++;
        }
      
        $alternative = Alternative::all();

        return view('pages.matrix.matrix', [
            'title' => 'Proses Matrix',
            'data'=> $data,
            'alternative' => $alternative,
            'criteria' => $criteria,
        ]);
    }
}
