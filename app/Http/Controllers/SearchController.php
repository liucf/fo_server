<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Fojing;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $fojings = Fojing::where('name', 'like', '%' . $keyword . '%')->get();
    	return  response()->json([
			'id' => 0,
	    	'name' => "",
	    	'describe' => "",
	    	'imageName' => "",
	    	'fojings' => $fojings
		]);
    }
}
