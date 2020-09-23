<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Semester;
use Carbon\Carbon;
use Session;
use App\Imports\SemesterImport;
use Maatwebsite\Excel\Facades\Excel;

class DataSemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        
       return view('admin.semester.semester',compact('semesters'));        
    }

    public function csv_import()
    {
        Excel::import(new SemesterImport, request()->file('file'));
        Session::flash('statuscode','success');
            return redirect('admin/master/semester')->with('status','Berhasil Menambahkan Data Semester');
    }

    public function store(Request $request){
        $this->validate($request,[
            'semester' => 'required'
        ],
        [
            'semester.required' => 'Semester Wajib Diisi',
        ]);

    
        $a = Semester::where(['semester'=>$request->semester])->get();

        //return $a[1];

        if($a->count() > 0){
            Session::flash('statuscode','error');
        return redirect('admin/master/semester')->with('status', 'Gagal Menambahkan Data Semester!');
        }else{
        

        $semesters = new Semester;
        
        $b = 'S'.Carbon::now()->format('ymdHi').rand(100,999);

        $semesters->id = $b;
        $semesters->semester = $request->input('semester');

        $semesters->save();
        
        Session::flash('statuscode','success');
        return redirect('admin/master/semester')->with('status', 'Berhasil Menambahkan Data Semester');
        }
    }

    public function edit(Request $request, $id)
    {
        $semesters = Semester::findOrFail($id);
        return view('admin.semester.edit', compact('semesters'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'semester' => 'required'
            
        ],
        [
            'semester.required' => 'Semester Wajib Diisi',
        ]);
        
        $semesters = Semester::find($id);

        $semesters->semester = $request->input('semester');

        $semesters->update();

        Session::flash('statuscode','success');
        return redirect('admin/master/semester')->with('status','Data Semester Berhasil Diubah');
    }

    public function delete($id){

        $semesters = Semester::findOrFail($id);
        $semesters->delete();

        Session::flash('statuscode','success');
        return redirect('admin/master/semester')->with('status', 'Berhasil Hapus Semester');
        
    }
}
