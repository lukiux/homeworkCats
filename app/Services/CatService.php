<?php

namespace App\Services;

use App\Visitor;

class CatService {

    CONST CACHE_KEY = 'CATS';
    
    protected function readFile() {

        $cats = array();
        $file = fopen("../cats.txt", "r");

        while(!feof($file)) {

            list($cat) = explode("\n", fgets($file));
            $cats[] = $cat;
        }

        return $cats;
    }

    public function getCatsComb() {

        $cats = $this->readFile();

        $rand_cats = array_rand($cats, 3);
        $combCats = array($cats[$rand_cats[0]], $cats[$rand_cats[1]], $cats[$rand_cats[2]]);

        return $combCats;
    }

    public function getCachedKey($id) {
        $key = strtoupper("get.{$id}");
        return self::CACHE_KEY . ".$key";
    }

    public function generateLogFile($catsCom, $n) {

        $dataJSON = array();

        $dataJSON['datetime'] = date(Visitor::where('page_id', $n)->latest()->first()->updated_at);
        $dataJSON['N'] = $n;
        $dataJSON['Cats'] = $catsCom;
        $dataJSON['countAll'] = Visitor::all()->count();
        $dataJSON['countN'] = Visitor::where('page_id', $n)->count();

        $fp = fopen('../log.json', 'w');
        fwrite($fp, json_encode($dataJSON));
        fclose($fp);
    }
}