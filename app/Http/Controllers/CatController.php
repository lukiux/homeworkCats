<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CatService;
use \Cache;

class CatController extends Controller
{
    CONST N = 1000000;
    CONST CACHE_KEY = 'CATS';
    protected $catService;

    public function __construct(CatService $cats) {
        $this->catService = $cats;
    }

    public function show($id) {

        $key = "get.{$id}";
        $cacheKey = $this->getCachedKey($key);

        if (0 >= $id || $id > self::N) {
            abort(404, "$id not found");
        }

        
        $data = Cache::remember($cacheKey, 60, function() {
            return $this->catService->getCatsComb();
        });
        return view('cat', ['catsComb' => $data]);
    }

    public function getCachedKey($key) {
        $key = strtoupper($key);
        return self::CACHE_KEY . ".$key";
    }
}
