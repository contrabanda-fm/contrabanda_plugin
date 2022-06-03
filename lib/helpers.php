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
function setmana_short($day){
    $week_short = array(
        'dilluns'  =>__('dl','contrabanda'),
        'dimarts'  =>__('dm','contrabanda'),
        'dimecres' =>__('dx','contrabanda'),
        'dijous'   =>__('dj','contrabanda'),
        'divendres'=>__('dv','contrabanda'),
        'dissabte' =>__('ds','contrabanda'),
        'diumenge' =>__('dg','contrabanda')
    );
    return $week_short[$day];
}
function setmana_i18n($day){
    $week_i18n= array(
        'dilluns'  =>__('dilluns','contrabanda'),
        'dimarts'  =>__('dimarts','contrabanda'),
        'dimecres' =>__('dimecres','contrabanda'),
        'dijous'   =>__('dijous','contrabanda'),
        'divendres'=>__('divendres','contrabanda'),
        'dissabte' =>__('dissabte','contrabanda'),
        'diumenge' =>__('diumenge','contrabanda')
    );
    return $week_i18n[$day];
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