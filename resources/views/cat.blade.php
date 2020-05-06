<?php

/*session_start();

if( isset( $_SESSION['counter'] ) ) {
    $_SESSION['counter'] += 1;
 }else {
    $_SESSION['counter'] = 1;
 }

echo "CountAll: " . $_SESSION['counter'] . "<br/>";*/



foreach ($catsComb as $key => $catComb) {
    
    if ($key == count($catsComb) - 1) {
        echo $catComb;
        break;
    }
    echo $catComb . ", ";
}