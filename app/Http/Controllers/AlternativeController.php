<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index(){
        return view("pages.alternative.index",
        [
            'data' => Alternative::all(),
            "title" => "Alternative"
        ]);
    }
    public function store(Request $request)
    {
        Alternative::create([
            'name' => $request->alternative,
        ]);

        return redirect()->back()->with(['success' => 'data alternative berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        Alternative::find($id)->delete();

        return back()->with(['delete' => 'Data alternative berhasil hapus']);

    }

    public function update(Request $request, $id)
    {
        $alternative = Alternative::find($id);
        $alternative->update([
            'name' => $request->alternative,
        ]);

        return redirect()->back()->with(['update' => 'Data alternative berhasil diupdate']);

    }
}
