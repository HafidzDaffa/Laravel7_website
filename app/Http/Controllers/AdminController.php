<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Kategori;
use App\Kategori1;
use App\Powerplay;
use App\Limcycle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use File;

class AdminController extends Controller
{
    public function index() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        return view('admin.index', $data);
    }

    public function powerplay() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['powerplays'] = DB::table('powerplays')
                            ->select('*','powerplays.id as pid')
                            ->leftJoin('kategoris','powerplays.kategori_id','=','kategoris.id')
                            ->orderBy('nama_barang', 'ASC')
                            ->paginate(10);
        return view('admin.powerplays', $data);
    }
    public function powerplay_search(Request $request) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $keyword = $request->search;

        $data['powerplays'] = DB::table('powerplays')
                            ->select('*','powerplays.id as pid')
                            ->leftJoin('kategoris','powerplays.kategori_id','=','kategoris.id')
                            ->where('kode_barang','LIKE','%'.$keyword.'%')
                            ->orWhere('nama_barang','LIKE','%'.$keyword.'%')
                            ->orWhere('kategoris','LIKE','%'.$keyword.'%')
                            ->paginate(5);
        $data['powerplays']->appends(['search' => $keyword]);
        return view('admin.powerplays', $data);
    }
    public function powerplay_create() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['kategori'] = Kategori::all();

        return view('admin.powerplays_add', $data);
    }

    public function powerplay_store(Request $request ,Powerplay $powerplays) {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategoris' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'required|file|image|max:5000',
            'gambar1' => 'required|file|image|max:5000',
            'gambar2' => 'required|file|image|max:5000'
        ]);
        // Generate Kode
        $dariDB = Powerplay::max('kode_barang');
        $nourut = substr($dariDB, 3, 4);
        $urutan = $nourut + 1;
        $huruf = "BRG";
        $kode = $huruf . sprintf("%03s", $urutan);

        $powerplays->kode_barang = $kode;
        $powerplays->nama_barang = $validateData['nama_barang'];
        $powerplays->kategori_id = $validateData['kategoris'];
        $powerplays->deskripsi = $validateData['deskripsi'];
        $powerplays->harga = $validateData['harga'];
        $powerplays->link = $validateData['link'];
        if($request->hasFile('gambar')) {
            $extFile = $request->gambar->getClientOriginalExtension();
            $namaFile = 'powerplays-'.time().".".$extFile;
            $path = $request->gambar->move('uploads/barang', $namaFile);
            $powerplays->gambar = $path;
        }
        if($request->hasFile('gambar1')) {
            $extFile = $request->gambar1->getClientOriginalExtension();
            $namaFile = 'powerplays1-'.time().".".$extFile;
            $path = $request->gambar1->move('uploads/barang', $namaFile);
            $powerplays->gambar1 = $path;
        }
        if($request->hasFile('gambar2')) {
            $extFile = $request->gambar2->getClientOriginalExtension();
            $namaFile = 'powerplays2-'.time().".".$extFile;
            $path = $request->gambar2->move('uploads/barang', $namaFile);
            $powerplays->gambar2 = $path;
        }
        $powerplays->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('powerplay');
    }

    public function powerplay_edit($id) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        $data['kategori'] = Kategori::all();
        $data['powerplays'] = Powerplay::find($id);

        return view('admin.powerplays_edit', $data);
    }

    public function powerplay_update(Request $request, Powerplay $powerplays) {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategoris' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'file|image|max:5000',
            'gambar1' => 'file|image|max:5000',
            'gambar2' => 'file|image|max:5000'
        ]);

        $powerplays->nama_barang = $validateData['nama_barang'];
        $powerplays->kategori_id = $validateData['kategoris'];
        $powerplays->deskripsi = $validateData['deskripsi'];
        $powerplays->harga = $validateData['harga'];
        $powerplays->link = $validateData['link'];
        if($request->hasFile('gambar')) {
            $extFile = $request->gambar->getClientOriginalExtension();
            $namaFile = 'powerplays-'.time().".".$extFile;
            File::delete($powerplays->gambar);
            $path = $request->gambar->move('uploads/barang', $namaFile);
            $powerplays->gambar = $path;
        }
        if($request->hasFile('gambar1')) {
            $extFile = $request->gambar1->getClientOriginalExtension();
            $namaFile = 'powerplays1-'.time().".".$extFile;
            File::delete($powerplays->gambar1);
            $path = $request->gambar1->move('uploads/barang', $namaFile);
            $powerplays->gambar1 = $path;
        }
        if($request->hasFile('gambar2')) {
            $extFile = $request->gambar2->getClientOriginalExtension();
            $namaFile = 'powerplays2-'.time().".".$extFile;
            File::delete($powerplays->gambar2);
            $path = $request->gambar2->move('uploads/barang', $namaFile);
            $powerplays->gambar2 = $path;
        }
        $powerplays->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('powerplay');
    }

    public function powerplay_destroy($id, Request $request) {
        $powerplays = Powerplay::find($id);
        File::delete($powerplays->gambar);
        File::delete($powerplays->gambar1);
        File::delete($powerplays->gambar2);
        Powerplay::find($id)->delete();
        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('powerplay');
    }

    public function kategori() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        $data['kategori'] = Kategori::all();


        return view('admin.kategoris', $data);
    }

    public function kategori_create() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        

        return view('admin.kategoris_add', $data);
    }

    public function kategori_store(Request $request) {
        $validateData = $request->validate([
            'kategoris' => 'required'
        ]);

        $kategori = new Kategori();
        $kategori->kategoris = $validateData['kategoris'];
        $kategori->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('kategori');
    }

    public function kategori_edit($id) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['kategori'] = Kategori::find($id);

        return view('admin.kategoris_edit', $data);
    }

    public function kategori_update(Request $request, Kategori $kategori) {
        $validateData = $request->validate([
            'kategoris' => 'required'
        ]);


        $kategori->kategoris = $validateData['kategoris'];
        $kategori->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('kategori');
    }

    public function kategori_destroy($id, Request $request, Powerplay $powerplays) {
        $powerplays = DB::table('powerplays')
                        ->where('kategori_id','=', $id)
                        ->first();
        if($powerplays) {
            session()->flash('error','Gagal!, Hapus / ubah kategori pada data barang dengan kategori tersebut terlebih dahulu');
            return redirect()->route('kategori');
        } else {
            Kategori::find($id)->delete();
            session()->flash('pesan','Berhasil');
            return redirect()->route('kategori');
        }
    }

    public function limcycle() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['limcycles'] = DB::table('limcycles')
                            ->select('*','limcycles.id as lid')
                            ->leftJoin('kategori1s','limcycles.kategori1_id','=','kategori1s.id')
                            ->orderBy('nama_barang', 'ASC')
                            ->paginate(10);
        return view('admin.limcycles', $data);
    }
    public function limcycle_search(Request $request) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $keyword = $request->search;

        $data['limcycles'] = DB::table('limcycles')
                            ->select('*','limcycles.id as lid')
                            ->leftJoin('kategori1s','limcycles.kategori1_id','=','kategori1s.id')
                            ->where('kode_barang','LIKE','%'.$keyword.'%')
                            ->orWhere('nama_barang','LIKE','%'.$keyword.'%')
                            ->orWhere('kategori1s','LIKE','%'.$keyword.'%')
                            ->paginate(5);
        $data['limcycles']->appends(['search' => $keyword]);
        return view('admin.limcycles', $data);
    }
    public function limcycle_create() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['kategori1'] = Kategori1::all();

        return view('admin.limcycles_add', $data);
    }

    public function limcycle_store(Request $request, Limcycle $limcycles) {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategori1s' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'required|file|image|max:5000',
            'gambar1' => 'required|file|image|max:5000',
            'gambar2' => 'required|file|image|max:5000'
        ]);
        // Generate Kode
        $dariDB = Limcycle::max('kode_barang');
        $nourut = substr($dariDB, 3, 4);
        $urutan = $nourut + 1;
        $huruf = "BRG";
        $kode = $huruf . sprintf("%03s", $urutan);

        $limcycles->kode_barang = $kode;
        $limcycles->nama_barang = $validateData['nama_barang'];
        $limcycles->kategori1_id = $validateData['kategori1s'];
        $limcycles->deskripsi = $validateData['deskripsi'];
        $limcycles->harga = $validateData['harga'];
        $limcycles->link = $validateData['link'];
        if($request->hasFile('gambar')) {
            $extFile = $request->gambar->getClientOriginalExtension();
            $namaFile = 'limcycles-'.time().".".$extFile;
            $path = $request->gambar->move('upload/barang', $namaFile);
            $limcycles->gambar = $path;
        }
        if($request->hasFile('gambar1')) {
            $extFile = $request->gambar1->getClientOriginalExtension();
            $namaFile = 'limcycles1-'.time().".".$extFile;
            $path = $request->gambar1->move('upload/barang', $namaFile);
            $limcycles->gambar1 = $path;
        }
        if($request->hasFile('gambar2')) {
            $extFile = $request->gambar2->getClientOriginalExtension();
            $namaFile = 'limcycles2-'.time().".".$extFile;
            $path = $request->gambar2->move('upload/barang', $namaFile);
            $limcycles->gambar2 = $path;
        }
        $limcycles->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('limcycle');
    }

    public function limcycle_edit($id) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        $data['kategori1'] = Kategori1::all();
        $data['limcycles'] = Limcycle::find($id);

        return view('admin.limcycles_edit', $data);
    }

    public function limcycle_update(Request $request, Limcycle $limcycles) {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'kategori1s' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'link' => 'required',
            'gambar' => 'file|image|max:5000',
            'gambar1' => 'file|image|max:5000',
            'gambar2' => 'file|image|max:5000'
        ]);

        $limcycles->nama_barang = $validateData['nama_barang'];
        $limcycles->kategori1_id = $validateData['kategori1s'];
        $limcycles->deskripsi = $validateData['deskripsi'];
        $limcycles->harga = $validateData['harga'];
        $limcycles->link = $validateData['link'];
        if($request->hasFile('gambar')) {
            $extFile = $request->gambar->getClientOriginalExtension();
            $namaFile = 'limcycles-'.time().".".$extFile;
            File::delete($limcycles->gambar);
            $path = $request->gambar->move('upload/barang', $namaFile);
            $limcycles->gambar = $path;
        }
        if($request->hasFile('gambar1')) {
            $extFile = $request->gambar1->getClientOriginalExtension();
            $namaFile = 'limcycles1-'.time().".".$extFile;
            File::delete($limcycles->gambar1);
            $path = $request->gambar1->move('upload/barang', $namaFile);
            $limcycles->gambar1 = $path;
        }
        if($request->hasFile('gambar2')) {
            $extFile = $request->gambar2->getClientOriginalExtension();
            $namaFile = 'limcycles2-'.time().".".$extFile;
            File::delete($limcycles->gambar2);
            $path = $request->gambar2->move('upload/barang', $namaFile);
            $limcycles->gambar2 = $path;
        }
        $limcycles->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('limcycle');
    }

    public function limcycle_destroy($id, Request $request ) {
        $limcycles= Limcycle::find($id);
        File::delete($limcycles->gambar);
        File::delete($limcycles->gambar1);
        File::delete($limcycles->gambar2);
        Limcycle::find($id)->delete();
        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('limcycle');
    }

    public function kategori1() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        $data['kategori1'] = Kategori1::all();


        return view('admin.kategori1s', $data);
    }

    public function kategori1_create() {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();
        $data['kategori1'] = Kategori1::all();

        return view('admin.kategori1s_add', $data);
    }

    public function kategori1_store(Request $request) {
        $validateData = $request->validate([
            'kategori1s' => 'required'
        ]);

        $kategori1 = new Kategori1();
        $kategori1->kategori1s = $validateData['kategori1s'];
        $kategori1->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('kategori1');
    }

    public function kategori1_edit($id) {
        $data['profile'] = Admin::find(session()->get('id_admin'));
        $data['jml_kategori'] = Kategori ::all()->count();
        $data['jml_kategori1'] = Kategori1 ::all()->count();
        $data['jml_barang1'] = Powerplay ::all()->count();
        $data['jml_barang2'] = Limcycle ::all()->count();

        $data['kategori1'] = Kategori1::find($id);

        return view('admin.kategori1s_edit', $data);
    }

    public function kategori1_update(Request $request, Kategori1 $kategori1) {
        $validateData = $request->validate([
            'kategori1s' => 'required'
        ]);


        $kategori1->kategori1s = $validateData['kategori1s'];
        $kategori1->save();

        $request->session()->flash('pesan','Berhasil');
        return redirect()->route('kategori1');
    }

    public function kategori1_destroy($id, Request $request, Limcycle $limcycle) {
        $limcycle = DB::table('limcycles')
                        ->where('kategori1_id','=', $id)
                        ->first();
        if($limcycle) {
            session()->flash('error','Gagal!, Hapus / ubah kategori pada data barang dengan kategori tersebut terlebih dahulu');
            return redirect()->route('kategori1');
        } else {
            Kategori1::find($id)->delete();
            session()->flash('pesan','Berhasil');
            return redirect()->route('kategori1');
        }
    }



}
