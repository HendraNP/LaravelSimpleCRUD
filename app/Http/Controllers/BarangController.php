<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;
use DB;
use App\Customer;
use App\Logs;
use Illuminate\Support\Facades\Session;


class BarangController extends Controller
{
    public $timestamps = false;

    public function index()
    {
    	$list = DB::connection('mysql')->table('Barang')->get();
        return view('barang.list', ['barang' => $list]);
    }

    public function create()
    {
    	return view('barang.create');
    }

    public function add(Request $request){
    	$nama = $request->input('nama');
        $kategori = $request->input('kategori');
        $harga = $request->input('harga');

    	$insert = DB::connection('mysql')->table('Barang')->insert(['Nama' => $nama, 'Kategori' => $kategori, 'Harga' => $harga]);

    	$message = 'Data inserted successfully';
    	return redirect()->to('/barang')->with(['message' => $message]);
    }

    public function edit($id){
    	$list = DB::connection('mysql')->table('Barang')->where('Kode', $id)->first();
    	return view('barang.edit', ['barang' => $list]);
    }

    public function set(Request $request, $id){
    	$nama = $request->input('nama');
    	$kategori = $request->input('kategori');
    	$harga = $request->input('harga');

    	$edit = DB::connection('mysql')->table('Barang')->where('Kode', $id)->update(['Nama' => $nama, 'Kategori' => $kategori, 'Harga' => $harga]);

    	$message = 'Data updated successfully';
    	return redirect()->to('/barang')->with(['message' => $message]);
    }

    public function delete($id){
    	$delete = DB::connection('mysql')->table('Barang')->where('Kode', $id)->delete();

    	$message = 'Data deleted successfully';
    	return redirect()->to('/barang')->with(['message' => $message]);
    }


}
