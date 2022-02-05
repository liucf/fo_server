<?php

use Inertia\Inertia;
use App\Models\Album;
use App\Models\Fojing;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/getdata', function () {
//     // http://fojia.daomobile.cn/api.php?c=music&a=album&album_id=1263
//     $url = "http://fojia.daomobile.cn/api.php?c=music&a=album&album_id=";
//     for($i=1; $i<1264; $i++) {
//     // for($i=1; $i<2; $i++) {
//         $getUrl = $url . $i;
//         $response = Http::get($getUrl);
//         $album = $response->json()['data']['head'];
//         $fojings = $response->json()['data']['body'];
//         $newAlbum = Album::firstOrCreate([
//             'name' => $album['name'],
//             'describe' => $album['describe'],
//             'imageName' => str_replace("http://img.xdmobile.cn/profile/fojia/", "", $album['imageName']),
//             'category_id' => $album['cat_id']
//         ]);

//         if (Storage::disk('udisk')->missing($newAlbum->imageName)) {
//             $contents = file_get_contents($album['imageName']);
//             Storage::disk('udisk')->put($newAlbum->imageName, $contents);
//         }

//         foreach ($fojings as $fojing) {
//             if (Fojing::where('pathName', '=', $fojing['pathName'])->where('name', '=', $fojing['name'])->exists()) {
//                 continue;
//             }

//             $newFojing = Fojing::firstOrCreate([
//                 'album_id' => $newAlbum['id'],
//                 'pathName' => $fojing['pathName'],
//                 'url' => str_replace("https://xd-bucket-fojing-001.oss-cn-beijing.aliyuncs.com/", "", $fojing['url']),
//                 'name' => $fojing['name'],
//                 'sort' => $fojing['sort'],
//                 'ext' => $fojing['ext'],
//                 'playback' => $fojing['Playback'],
//                 'filesize' => $fojing['filesize'],
//                 'type' => $fojing['type'],
//                 'jump_url' => $fojing['jump_url'],
//                 'cover' => str_replace("http://img.xdmobile.cn/profile/fojia/", "", $fojing['cover'])
//             ]);


//             if (Storage::disk('udisk')->missing($newFojing->url)) {
//                 $contents = file_get_contents($fojing['url']);
//                 Storage::disk('udisk')->put($newFojing->url, $contents);
//             }

//             if (Storage::disk('udisk')->missing($newFojing->cover)) {
//                 $contents = file_get_contents($fojing['cover']);
//                 Storage::disk('udisk')->put($newFojing->cover, $contents);
//             }
//             echo $newFojing->id . "<br/>";
//         }

//     }
// });
