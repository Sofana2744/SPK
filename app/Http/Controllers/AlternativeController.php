<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\SubAlternative;
use App\Models\NormalisasiAlternative;

class AlternativeController extends Controller
{
    public function index(){

        return view("pages.alternative.index",
        [
            'data' => Alternative::all(),
            'dataCriteria' => Criteria::all(),
            "title" => "Alternative",
            'dataSubAlternative' => SubAlternative::all(),
            'normalisasi' => SubAlternative::all(),
        ]);
    }
    public function store(Request $request)
    {
        $criteria = Criteria::all();

        Alternative::create([
            'name' => $request->alternative,
        ]);

        foreach ($criteria as $key => $row)
        {
            $value = 'isi_'.$row->id;
            $cri = 'criteria_'.$row->id;
            SubAlternative::create([
                'alternative_id' => Alternative::all()->last()->id,
                'criteria_id' => $request->$cri,
                'value' => $request->$value
            ]);
        }

        $this->normalisasiAlternative();

        return redirect()->back()->with(['success' => 'data alternative berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        NormalisasiAlternative::truncate();
        SubAlternative::where('alternative_id', $id)->delete();
        Alternative::find($id)->delete();
        $this->normalisasiAlternative();
        return back()->with(['delete' => 'Data alternative berhasil hapus']);

    }

    public function update(Request $request, $id)
    {
        $criteria = Criteria::all();
        $alternative = Alternative::find($id);
        $alternative->update([
            'name' => $request->alternative,
        ]);

        foreach ($criteria as $key => $row)
        {
            $subAlternative = SubAlternative::where('alternative_id', $id)->where('criteria_id', $row->id); 
            $value = 'isi_'.$row->id;
            $cri = 'criteria_'.$row->id;
            $subAlternative->update([
                'alternative_id' => $id,
                'criteria_id' => $request->$cri,
                'value' => $request->$value
            ]);
        }

        $this->normalisasiAlternative();

        return redirect()->back()->with(['update' => 'Data alternative berhasil diupdate']);

    }

    public function normalisasiAlternative()
    {
        $dataMax = array();
        $dataMin = array();

        foreach (Criteria::all() as $key => $row)
        {
            $min = SubAlternative::where('criteria_id', $row->id)->min('value');
            array_push($dataMin, $min);
            $max = SubAlternative::where('criteria_id', $row->id)->max('value');
            array_push($dataMax, $max);
        }

        NormalisasiAlternative::truncate();

        foreach(Alternative::all() as $key => $row)
        {
            $index = 0;
            foreach($row->subAlternative as $key => $item){
                if($dataMax[$index] - $dataMin[$index] == 0)
                {
                    NormalisasiAlternative::create([
                        'sub_alternative_id' => $item->id,
                        'value' => 0,
                    ]);
                }else{
                    NormalisasiAlternative::create([
                        'sub_alternative_id' => $item->id,
                        'value' => (($item->value - $dataMin[$index]) / ($dataMax[$index] - $dataMin[$index])),
                    ]);
                }
                    $index++;
            }
        }
    }
}
