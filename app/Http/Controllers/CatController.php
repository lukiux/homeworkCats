<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\CatService;
use App\Visitor;
use \Cache;

class CatController extends Controller
{
    CONST N = 1000000;
    protected $catService;

    public function __construct(CatService $cats) {
        $this->catService = $cats;
    }

    public function show($pageId) {
         
        session_start();
        $currentSessionId = "";

        if (0 >= $pageId || $pageId > self::N) {
            abort(404, "$pageId not found");
        }

        $visitor = Visitor::firstOrCreate([
            'page_id' => $pageId,
            'session_id' => session_id()
        ]);

        $catsCom = Cache::remember($this->catService->getCachedKey($pageId), 60, function() {
            return $this->catService->getCatsComb();
        });

        $this->catService->generateLogFile($catsCom, $pageId);
        
        return view('cat', ['catsComb' => $catsCom]);
    }
}