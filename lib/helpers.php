<?php 
function setmana(){
    return array(
        'dilluns',
        'dimarts',
        'dimecres',
        'dijous',
        'divendres',
        'dissabte',
        'diumenge'
    );
}

function get_hour_48_to_24($hour){
    $hours = floor($hour/2);
    if($hour%2==0){
        $minutes = '00';
    }else{
        $minutes = '30';
    }
    return $hours.':'.$minutes;
}