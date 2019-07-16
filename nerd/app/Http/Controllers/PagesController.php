<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function service(){
        $title = "Serviços !!";
        return view('pages.service')->with('title', $title);
    }
}
