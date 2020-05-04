<?php

foreach ($catsComb as $key => $catComb) {
    
    if ($key == count($catsComb) - 1) {
        echo $catComb;
        break;
    }
    echo $catComb . ", ";
}