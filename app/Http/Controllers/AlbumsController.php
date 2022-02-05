<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index($category_id, $page=1)
    {
    	return Album::where('category_id', $category_id)
        ->select('id', 'name', 'describe', 'imageName')->orderBy('id','asc')->skip(12*($page-1))->take(12)->get();
    }

    public function show(Album $album)
	{
		return  response()->json([
			'id' => $album->id,
	    	'name' => $album->name,
	    	'describe' => $album->describe,
	    	'imageName' => $album->imageName,
	    	'fojings' => $album->fojings
		]);
	}
}
