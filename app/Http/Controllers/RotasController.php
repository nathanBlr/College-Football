<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Organization;
use Illuminate\Http\Request;

class RotasController extends Controller
{
    public function index(){
        $organizations = Organization::get();
        return view('cfb.index',['organizations'=>$organizations]);
    }
    public function divisions(Organization $organization){
        $divisions = Division::where('id',$organization->id)->get();
        return view('cfb.divisions',['organization'=>$organization,'divisions'=>$divisions]);
    }
}
