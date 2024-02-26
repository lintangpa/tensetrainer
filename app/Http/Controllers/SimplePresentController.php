<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimplePresentController extends Controller
{
    public function index(){
        return view('user.simplepresent');
    }
    
    public function quest1(){
        return view('user.quizsimplepresent');
    }

    public function quest2(){
        return view('user.tictactoepresent');
    }
}
