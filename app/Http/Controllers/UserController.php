<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Kategori;
use App\Kategori1;
use App\Powerplay;
use App\Limcycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use File;

class UserController extends Controller
{
    public function index() {
        $data['kategori'] = Kategori::all();                  
        $data['powerplays'] = DB::table('powerplays')
                                ->select('*','powerplays.id as pid')
                                ->leftJoin('kategoris','powerplays.kategori_id','kategoris.id')
                                ->orderBy('nama_barang', 'ASC')
                                ->paginate(10);
        return view('user.barangpowerplay', $data);
    }

    public function kategori($kategoris) {
        $data['kategori'] = Kategori::all();
        $data['powerplays'] = DB::table('powerplays')
                                ->select('*','powerplays.id as pid')
                                ->leftJoin('kategoris','powerplays.kategori_id','kategoris.id')
                                ->where('kategoris.kategoris','=',$kategoris)
                                ->orderBy('nama_barang', 'ASC')
                                ->paginate(10);
        return view('user.barangpowerplay', $data);
    }
    public function show($kode) {
        $data['kategori'] = Kategori::all();
        $data['powerplays'] = DB::table('powerplays')
                                ->select('*','powerplays.id as pid')
                                ->leftJoin('kategoris','powerplays.kategori_id','kategoris.id')
                                ->where('powerplays.kode_barang','=',$kode)
                                ->first();
        return view('user.barangpowerplay', $data);
    }
    public function search(Request $request) {
        $data['kategori'] = Kategori::all();
        $keyword = $request->search;
        $data['powerplays'] = DB::table('powerplays')
                                ->select('*','powerplays.id as pid')
                                ->leftJoin('kategoris','powerplays.kategori_id','=','kategoris.id')
                                ->where('kode_barang','LIKE','%'.$keyword.'%')
                                ->where('nama_barang','LIKE','%'.$keyword.'%')
                                ->orWhere('kategoris','LIKE','%'.$keyword.'%')
                                ->paginate(10);
        $data['powerplays']->appends(['search' => $keyword]);
        return view('user.barangpowerplay', $data);
    }

    public function index1() {
        $data['kategori1'] = Kategori1::all();
        $data['limcycles'] = DB::table('limcycles')
                                ->select('*','limcycles.id as lid')
                                ->leftJoin('kategori1s','limcycles.kategori1_id','kategori1s.id')
                                ->orderBy('nama_barang', 'ASC')
                                ->paginate(10);
        return view('user.baranglimcycle', $data);
    }

    public function kategori1($kategori1s) {
        $data['kategori1'] = Kategori1::all();
        $data['limcycles'] = DB::table('limcycles')
                                ->select('*','limcycles.id as lid')
                                ->leftJoin('kategori1s','limcycles.kategori1_id','kategori1s.id')
                                ->where('kategori1s.kategori1s','=',$kategori1s)
                                ->orderBy('nama_barang', 'ASC')
                                ->paginate(10);
        return view('user.baranglimcycle', $data);
    }
    public function show1($kode1) {
        $data['kategori1'] = Kategori1::all();
        $data['limcycles'] = DB::table('limcycles')
                                ->select('*','limcycles.id as lid')
                                ->leftJoin('kategori1s','limcycles.kategori1_id','kategori1s.id')
                                ->where('limcycles.kode_barang','=',$kode1)
                                ->first();
        return view('user.baranglimcycle', $data);
    }

    public function search1(Request $request) {
        $data['kategori1'] = Kategori1::all();
        $keyword = $request->search;
        $data['limcycles'] = DB::table('limcycles')
                                ->select('*','limcycles.id as lid')
                                ->leftJoin('kategori1s','limcycles.kategori1_id','kategori1s.id')
                                ->where('nama_barang','LIKE','%'.$keyword.'%')
                                ->orWhere('kategori1s','LIKE','%'.$keyword.'%')
                                ->paginate(10);
        $data['limcycles']->appends(['search' => $keyword]);
        return view('user.baranglimcycle', $data);
    }

    public function detail($id) {
        $data['kategori'] = Kategori::all();
        $data['powerplays'] = Powerplay::find($id);
        return view('user.detailpowerplay', $data);
        
    }
    public function detail1($id) {
        $data['kategori1'] = Kategori1::all();
        $data['limcycles'] = Limcycle::find($id);
        return view('user.detaillimcycle', $data);
        
    }
}
