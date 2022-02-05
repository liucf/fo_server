<?php

namespace App\Http\Controllers;

use App\Models\Fojing;
use Illuminate\Http\Request;

class FojingsController extends Controller
{
    public function show(Fojing $fojing)
	{
		return  response()->json([
			'id' => $fojing->id,
	    	'name' => $fojing->name,
	    	'url' => $fojing->url,
	        'album_id' => $fojing->album_id,
	    	'album_image' => $fojing->album->imageName
		]);
	}
}
