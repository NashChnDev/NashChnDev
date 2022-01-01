<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
class LocalvariableController extends Controller
{

    public function index($data)
    {       
        
        $path = 'json/globaldata.json';
        $content = file_get_contents($path);
        $array = json_decode($content,true);
        return $array;
    }
}