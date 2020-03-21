<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComputerController extends Controller
{
    function getMove(){
        $moves =[
            ['move' => "rock"],
            ['move' => "paper"],
            ['move' => "scissor"],
        ];
        $randMove = $moves[rand(0,sizeof($moves)-1)];
        return response()->json($randMove);
    }
}
