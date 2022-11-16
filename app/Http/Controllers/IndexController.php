<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;


class IndexController extends Controller
{
    public $timestamps = false;

    public function index()
    {
        return view('index');
    }


}
