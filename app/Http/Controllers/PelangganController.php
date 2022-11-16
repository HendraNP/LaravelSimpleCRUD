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


class PelangganController extends Controller
{
    public $timestamps = false;

    public function index()
    {
    	$list = DB::connection('mysql')->table('Pelanggan')->get();
        return view('pelanggan.list', ['pelanggan' => $list]);
    }

    public function create()
    {
    	return view('pelanggan.create');
    }

    public function add(Request $request){
    	$nama = $request->input('nama');
    	$domisili = $request->input('domisili');
    	$gender = $request->input('gender');

    	$insert = DB::connection('mysql')->table('Pelanggan')->insert(['Nama' => $nama, 'Domisili' => $domisili, 'Jenis_Kelamin' => $gender]);

    	$message = 'Data inserted successfully';
    	return redirect()->to('/pelanggan')->with(['message' => $message]);
    }

    public function edit($id){
    	$list = DB::connection('mysql')->table('Pelanggan')->where('ID_Pelanggan', $id)->first();
    	return view('pelanggan.edit', ['pelanggan' => $list]);
    }

    public function set(Request $request, $id){
    	$nama = $request->input('nama');
    	$domisili = $request->input('domisili');
    	$gender = $request->input('gender');

    	$edit = DB::connection('mysql')->table('Pelanggan')->where('ID_Pelanggan', $id)->update(['Nama' => $nama, 'Domisili' => $domisili, 'Jenis_Kelamin' => $gender]);

    	$message = 'Data updated successfully';
    	return redirect()->to('/pelanggan')->with(['message' => $message]);
    }

    public function delete($id){
    	$delete = DB::connection('mysql')->table('Pelanggan')->where('ID_Pelanggan', $id)->delete();

    	$message = 'Data deleted successfully';
    	return redirect()->to('/pelanggan')->with(['message' => $message]);
    }


}
