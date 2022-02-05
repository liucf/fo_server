<?php

namespace App\Console\Commands;

use App\Models\Album;
use App\Models\Fojing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetchdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         // http://fojia.daomobile.cn/api.php?c=music&a=album&album_id=1263
        $url = "http://fojia.daomobile.cn/api.php?c=music&a=album&album_id=";
        for($i=1; $i<1264; $i++) {
        // for($i=1; $i<2; $i++) {
            $getUrl = $url . $i;
            $response = Http::get($getUrl);
            $album = $response->json()['data']['head'];
            $fojings = $response->json()['data']['body'];
            $newAlbum = Album::firstOrCreate([
                'name' => $album['name'],
                'describe' => $album['describe'],
                'imageName' => str_replace("http://img.xdmobile.cn/profile/fojia/", "", $album['imageName']),
                'category_id' => $album['cat_id']
            ]);

            if (Storage::disk('udisk')->missing($newAlbum->imageName)) {
                $contents = file_get_contents($album['imageName']);
                Storage::disk('udisk')->put($newAlbum->imageName, $contents);
            }

            foreach ($fojings as $fojing) {
                if (Fojing::where('pathName', '=', $fojing['pathName'])->where('name', '=', $fojing['name'])->exists()) {
                    continue;
                }

                $newFojing = Fojing::firstOrCreate([
                    'album_id' => $newAlbum['id'],
                    'pathName' => $fojing['pathName'],
                    'url' => str_replace("https://xd-bucket-fojing-001.oss-cn-beijing.aliyuncs.com/", "", $fojing['url']),
                    'name' => $fojing['name'],
                    'sort' => $fojing['sort'],
                    'ext' => $fojing['ext'],
                    'playback' => $fojing['Playback'],
                    'filesize' => $fojing['filesize'],
                    'type' => $fojing['type'],
                    'jump_url' => $fojing['jump_url'],
                    'cover' => str_replace("http://img.xdmobile.cn/profile/fojia/", "", $fojing['cover'])
                ]);


                if (Storage::disk('udisk')->missing($newFojing->url)) {
                    if (false === ($contents = @file_get_contents($fojing['url']))) {
                        echo $newFojing->id . "<br/>";
                        continue;
                    }
                    Storage::disk('udisk')->put($newFojing->url, $contents);
                }

                if (Storage::disk('udisk')->missing($newFojing->cover)) {
                    $contents = file_get_contents($fojing['cover']);
                    Storage::disk('udisk')->put($newFojing->cover, $contents);
                }
               
            }

        }
    }
}
