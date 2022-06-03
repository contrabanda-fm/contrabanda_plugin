<?php //filter title to display graella
add_filter( 'the_content', 'add_program_metas');
function add_program_metas($content){
    if(is_singular('programa')){

        $post_id = get_the_id();
        $content = program_jumbo($post_id).$content;
    }
    return $content;
}
function program_jumbo($post_id){
    $program_schedule = get_program_schedule($post_id);
    $runtimes = "<div class='program__schedule'>";
    if(!empty($program_schedule['live'])){
        $runtimes .= "<p><small><strong>".__('Directe','contrabanda')."</strong></small></p>";
        $runtimes .= "<ul class='program__schedule--live'>";
        foreach($program_schedule['live'] as $schedule){
            $runtimes .= "<li><small>${schedule}</small></li>";
        }
        $runtimes .= "</ul>";
    }
    if(!empty($program_schedule['rerun'])){
        $runtimes .= "<p><small><strong>".__('Repeticions','contrabanda')."</strong></small></p>";
        $runtimes .= "<ul class='program__schedule--rerun'>";
        foreach($program_schedule['rerun'] as $schedule){
            $runtimes .= "<li><small>${schedule}</small></li>";
        }
        $runtimes .= "</ul>";
    }
    $runtimes .= "</div>";

    $podcast = get_field('podcast', $post_id);
    $nice_podcast = preg_replace( "#^[^:/.]*[:/]+#i", "", $podcast );
    $feed = get_field('feed', $post_id);
    $mail = get_field('mail', $post_id);
    $facebook = get_field('facebook', $post_id);
    $twitter = get_field('twitter', $post_id);
    
    $jumbo = "<div class='program__metas'>";
    $jumbo .= $runtimes;
    $jumbo .= "<p class='program__podcast'><strong><a href='${podcast}' title='podcast'>${nice_podcast}</a></strong></p>";
    $jumbo .= "<p class='program__links'>";
    $jumbo .= "<a href='${feed}' title='rss feed'><span class='dashicons dashicons-rss'></span></a>";
    if(!empty($facebook)) { 
        $jumbo .= "<a href='${facebook}' title='facebook'><span class='dashicons dashicons-facebook'></span></a>";
    }
    if(!empty($twitter)) { 
        $jumbo .= "<a href='${facebook}' title='twitter'><span class='dashicons dashicons-twitter'></span></a>";
    }
    $jumbo .= "</p>";
    $jumbo .= "</div>";
    return $jumbo;
}

function get_program_schedule($post_id){
    $program_schedule = [
        'live' => [],
        'rerun' => []
    ];
    foreach(setmana() as $day){
        $day_schedule = get_field($day, 'options');
        if(!empty($day_schedule)){
            foreach($day_schedule as $block){
                if($block['programa']==$post_id){
                    $hour = $block['hora'];
                    if(!empty($block['directe'])){
                        $program_schedule['live'][] = "${day} ${hour}";
                    }else{
                        $program_schedule['rerun'][] = "${day} ${hour}";
                    }
                }
            }
        }
    }

    return $program_schedule;
}
?>