<?php

namespace App\Services;

class CatService {

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
}