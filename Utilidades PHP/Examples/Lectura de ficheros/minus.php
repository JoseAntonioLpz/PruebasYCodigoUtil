<?php

function formatWord($word){
    $first = strtoupper(substr($word, 0, 1));
    $lowerCase = mb_strtolower(substr($word, 1));
    return $first .  $lowerCase;
}
