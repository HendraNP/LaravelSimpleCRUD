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


class PenjualanController extends Controller
{
    public $timestamps = false;

    public function index()
    {
    	$list = DB::connection('mysql')->table('Penjualan')->join('Pelanggan','Penjualan.Kode_Pelanggan','=','Pelanggan.ID_Pelanggan')->join('Item_Penjualan','Item_Penjualan.Nota','=','Penjualan.ID_Nota')->join('Barang','Barang.Kode','=','Item_Penjualan.Kode_Barang')->select('Pelanggan.Nama as custName','Tgl', 'Barang.Nama as itemName', 'Subtotal', 'ID_Nota')->get();
        return view('penjualan.list', ['penjualan' => $list]);
    }

    public function create()
    {
        $itemlist = DB::connection('mysql')->table('Barang')->get();
        $userlist = DB::connection('mysql')->table('Pelanggan')->get();
    	return view('penjualan.create', ['itemlist' => $itemlist,'userlist' => $userlist]);
    }

    public function add(Request $request){
    	$barang = $request->input('barang');
        $pelanggan = $request->input('pelanggan');
        $tgl = $request->input('tgl');
        $subtotal = $request->input('subtotal');

        $barang = explode('-', $barang);

        //$tgl = explode('-', $tgl);
        //$tgl = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];

    	$insert = DB::connection('mysql')->table('Penjualan')->insert(['Kode_Pelanggan' => $pelanggan, 'Tgl' => $tgl, 'Subtotal' => $subtotal]);
        $nota = DB::connection('mysql')->table('Item_Penjualan')->insert(['Kode_Barang' => $barang[0]]);

    	$message = 'Data inserted successfully';
    	return redirect()->to('/penjualan')->with(['message' => $message]);
    }

    public function edit($id){
    	$list = DB::connection('mysql')->table('Penjualan')->join('Item_Penjualan','Penjualan.ID_Nota','=','Item_Penjualan.Nota')->where('ID_Nota', $id)->first();
        $itemlist = DB::connection('mysql')->table('Barang')->get();
        $userlist = DB::connection('mysql')->table('Pelanggan')->get();
    	return view('penjualan.edit', ['penjualan' => $list, 'itemlist' => $itemlist,'userlist' => $userlist]);
    }

    public function set(Request $request, $id){
    	$kode = $request->input('pelanggan');
    	$tgl = $request->input('tgl');
    	$subtotal = $request->input('subtotal');
        $barang = $request->input('barang');
        $barang = explode('-', $barang);

    	$edit = DB::connection('mysql')->table('Penjualan')->where('ID_Nota', $id)->update(['Kode_Pelanggan' => $kode, 'Tgl' => $tgl, 'Subtotal' => $subtotal]);
        $edit2 = DB::connection('mysql')->table('Item_Penjualan')->where('Nota', $id)->update(['Kode_Barang' => $barang[0]]);

    	$message = 'Data updated successfully';
    	return redirect()->to('/penjualan')->with(['message' => $message]);
    }

    public function delete($id){
    	$delete = DB::connection('mysql')->table('Penjualan')->where('ID_Nota', $id)->delete();
        $delete = DB::connection('mysql')->table('Item_Penjualan')->where('Nota', $id)->delete();

    	$message = 'Data deleted successfully';
    	return redirect()->to('/penjualan')->with(['message' => $message]);
    }


}
