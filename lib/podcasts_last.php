<?php 
function display_podcasts(){
    $podcast_loop = '';
    $last_podcasts = get_contrabanda_podcasts();
    foreach($last_podcasts as $podcast){
        $podcast_loop .= build_podcast_card($podcast);
    }
    $podcasts_title = __('Darrers programes','contrabanda');
    $podcast_row = "<h2 class='last-programs'>${podcasts_title}</h2><div class='row'>${podcast_loop}</div>";
    echo $podcast_row;
}

function get_contrabanda_podcasts(){
    $last_podcasts = [];
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'programa' ),
        'post_status'            => array( 'published' ),
        'posts_per_page'         => -1,
        'tax_query'              => array(
            array(
                'taxonomy'         => 'tipus',
                'terms'            => 'contrabanda',
                'field'            => 'slug',
            ),
        )
    );

    // The Query
    $programs_query = new WP_Query( $args );

    while( $programs_query->have_posts() ) : $programs_query->the_post();
        $thumbnail = get_the_post_thumbnail_url();
        $program = get_the_title();
        $podcast = preg_replace("(^https?://)", "", get_field('podcast') );
        $site_args = array(
            'domain' => $podcast
        );
        $site = get_sites($site_args);
        $podcast_id=$site[0]->blog_id;
        $site_details = get_blog_details($podcast_id);
        $last_podcast = get_last_podcast($podcast_id);
        if($last_podcast){
            $last_podcast['thumbnail'] = $thumbnail;
            $last_podcast['program'] = $program;
            $last_podcasts[$last_podcast['date']] = $last_podcast;
        }
    endwhile;
    krsort($last_podcasts);
    return $last_podcasts;
}
function get_last_podcast($podcast_id){
    switch_to_blog($podcast_id);
    $month_ago = strtotime("-1 month");
    $args = array(
        'posts_per_page' => 1,
        'after'    => date('Y-m-d',$month_ago),
    );
    $last_post_query = new WP_Query( $args );
    while( $last_post_query->have_posts() ) : $last_post_query->the_post();
        if(get_the_date("Ymd")<date('Ymd',$month_ago)){
            restore_current_blog();
            return null;
        }
        if(get_the_id()==1){
            restore_current_blog();
            return null;
        }
        $last_podcast = array(
            'title' => get_the_title(),
            'link'  => get_permalink(),
            'excerpt' => get_the_excerpt(),
            'date'  => get_the_date("Ymdis"),
            'the_date' => get_the_date()
        );
    endwhile;
    wp_reset_query();
    restore_current_blog();
    return $last_podcast;
}
function build_podcast_card($podcast){
    $title = $podcast['title'];
    $link = $podcast['link'];
    $excerpt = $podcast['excerpt'];
    $date = $podcast['the_date'];
    $program = $podcast['program'];
    $thumbnail= $podcast['thumbnail'];
    $card_thumb;
    if($thumbnail){
        $card_thumb = "<div class='card-thumb' style='background-image:url(${thumbnail});'></div>";
    }
    $card = 
    "<div class='col-sm-12 col-md-6 col-lg-4'>
        <div class='card'>
            ${card_thumb}
            <div class='card-body'>
            <h5 class='card-title'><a href='${link}'>${title}</a></h5>
            <p class='card-text'>${excerpt}</p>
            <p><span class='badge badge-secondary'>${program}</span></p>
            <p><span class='badge badge-secondary'>${date}</span></p>
            </div>
        </div>
    </div>";
    return $card;
}