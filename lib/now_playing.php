<?php 

add_action('contrabanda_player','get_player');

function get_player(){
    $week_day = setmana()[date('w')-1];
    $day_schedule = get_field($week_day, 'options');
    $daily_schedule = build_daily_schedule_array($day_schedule);
    date_default_timezone_set('Europe/Madrid');
    $hour = date('H');
    $minutes = date('i');
    $minutes < 30 ? $half_hour = 0 : $half_hour = 1;
    $hour_48 = $hour*2+$half_hour;
    $now_playing = null;
    foreach($daily_schedule as $hour => $block){
        if($hour <= $hour_48){
            $now_playing = $block;
        }
    }
    $block_id = $now_playing['program'];
    if($block_id !=0){
        $program_title = get_the_title($block_id);
        $program_link = get_permalink($block_id);
        $now_playing_link = "<a href='${program_link}'>${program_title}</a>";
    }else{
        $now_playing_link = __('Música','contrabanda'); 

    }

    $streaming_url = get_field('streaming_url','options');
    $streaming_url_playlist = get_field('streaming_url_playlist','options');
    echo "<audio controls>
        <source src='${streaming_url}' type='audio/ogg'>
        <source src='${streaming_url_playlist}'>
    </audio>";
    
    
    echo "<div class='nowplaying' id='nowplaying'><div>".date('H:i').": ${now_playing_link}</div>";
    $listen_help = get_field('sentir_online','options');
    $listen_help_title = get_the_title($listen_help);
    $listen_help_link = get_permalink($listen_help);
    echo "<div>${listen_help_title}<a href='${listen_help_link}'>(?)</a></div></div>";
        
}