<?php
    //filter content to display graella
    add_filter( 'the_content', 'add_graella');
    function add_graella($content){
        $graella_page = get_field('pagina_de_programacio','options');
        if(!$graella_page){
            return $content;
        }
        if(is_page($graella_page->ID)){
            $content .= display_graella();
        }
        return $content;
    }

    function display_graella(){
        $graella = '';
        $graella_dia = setmana()[date('N')-1];
        $graella_wrapper = "<div id='graella' class='graella ${graella_dia}'>";
        $graella_wrapper_close = '</div>';

        $hours_column = generate_hour_column();
        $program_columns = generate_program_column();

        $graella .= build_graella_labels('').build_week_navigation().$graella_wrapper.$hours_column.$program_columns.$hours_column.$graella_wrapper_close.build_graella_labels('large');

        return $graella;
    }
    function generate_hour_column(){
        $hours = array();
        for($h=0; $h<24; $h++){
            $hours[] = $h;
        }
        $hours_column = '<div class="graella__column graella__column--hours">';
        $hours_column .= "<div class='graella__block graella__block--hour graella__block--heading'></div>";
        foreach($hours as $hour){
            $hours_column .= "<div class='graella__block graella__block--hour'>${hour}:00</div>";
            $hours_column .= "<div class='graella__block graella__block--hour'></div>";
        }
        $hours_column .= '</div>';

        return $hours_column;
    }
    function generate_program_column(){
        $programes = '';
        foreach(setmana() as $day){
            $day_schedule = get_field($day, 'options');
            $day_blocks = build_daily_schedule_array($day_schedule);
            $programes .= "<div class='graella__column graella__column--day graella__column--${day}'>";
            $programes .= "<div class='graella__block graella__block--block graella__block--heading graella__block--duration-1'>".setmana_i18n($day)."</div>";
            foreach($day_blocks as $block){
                if($block['program']==0){
                    $block_name = __('Música','contrabanda');
                    $block_type = __('musica','contrabanda');
                }else{
                    $block_name = get_the_title($block['program']);
                    $block_types = get_the_terms($block['program'],'tipus');
                    $block_type = $block_types[0]->slug;
                }
                $block_quinzenal = get_field('quinzenal',$block['program']) ? '*' : '';
                $block_start = get_hour_48_to_24($block['start']);
                $block_duration = $block['finish']-$block['start'];
                $program_classes = "graella__block graella__block--block graella__block--duration-${block_duration}";
                $program_classes .= " graella__block--${block_type}";
                if(!empty($block['directe'])){
                    $program_classes .= " graella__block--directe";
                }
                $programes .= "<div class='${program_classes}'>";
                $programes .= "<div class='graella__block-time'>${block_start}</div>";
                if($block['program']==0){
                    $programes .= "<div class='graella__block__name'>${block_name}${block_quinzenal}</div>";
                }else{
                    $block_link = get_permalink($block['program']);
                    $programes .= "<div class='graella__block__name'>";
                    $programes .= "<a href='${block_link}'>${block_name}${block_quinzenal}</a>";
                    $programes .= "</div>";
                }
                $programes .= "</div>";
            }
            $programes .= '</div>';
        }
        return $programes;
    }
    function program_per_hour($day,$hour){
        $program = false;
        if(!empty($day)){
            foreach($day as $programa){
                if($programa['hora'] ==$hour){
                    $program = [
                        'programa' => $programa['programa'],
                        'directe' => $programa['directe']
                    ];
                }
            }
        }
        return $program;
    }
    function build_daily_schedule_array($day_schedule){
            $programs = [];
            for($h=0; $h<48; $h++){
                $hour = get_hour_48_to_24($h);
                $this_hour_program = program_per_hour($day_schedule,$hour);
                if($this_hour_program){
                    $programs[$h] = [
                        'program'   =>$this_hour_program['programa'],
                        'start'     =>$h,
                        'finish'    =>$h+get_field('durada',$this_hour_program['programa'])/30,
                        'directe'   =>$this_hour_program['directe']
                    ];
                    if(get_field('directe',$this_hour_program)){
                        $programs[$h]['directe'] = 'directe';
                    }
                }
            }
            $music=[];
            if(empty($programs[0])){
                $music[0] = [
                    'program'   =>0,
                    'start'     =>0,
                ];
            }
            $program_block=0;
            foreach($programs as $h => $program){
                if($h!=0 && $program_block==0){
                    $music[0]['finish']=$h;
                }
                if(empty($programs[$program['finish']])&&$program['finish']!=48){
                    $music[$program['finish']]= [
                        'program'   =>0,
                        'start'     =>$program['finish'],
                    ];
                }
                $program_block++;
            }
            $schedule=$programs+$music;
            ksort($schedule);
            $previous_block = null;
            foreach($schedule as $key => $block){
                if($previous_block && $schedule[$previous_block]['program']==0){
                    $schedule[$previous_block]['finish']=$schedule[$key]['start'];
                }
                $previous_block=$key;
            }
            $last_block = array_key_last($schedule);
            $schedule[$last_block]['finish'] = 48;
            return $schedule;
    }
    function build_week_navigation(){
        $navigation = "<ul class='nav nav-tabs flex-row graella__navigation navigation' id='myTab' role='tablist'>";
        foreach(setmana() as $key=>$day){
            date('N')-1 == $key ? $active='active' : $active = null;
            date('N')-1 == $key ? $selected='true' : $selected = false;
            $setmana_short = setmana_short($day);
            $navigation .="<li class='flex-start navigation__item nav-item ${active}'>
            <button class='nav-link navigation__item--button ${active}' id='${day}-tab' day-target='${day}' type='button' role='tab' aria-controls='${day}' aria-selected='${selected}'>${setmana_short}</button>
          </li>";
        }
        $navigation .= "</ul>";

        return $navigation;
    }

    function build_graella_labels($class){
        $labels = "<ul class='graella__labels ${class}'>";
        $labels .= "<li class='graella__block--block graella__block--musica'>".__('Música','contrabanda')."</li>";
        $labels .= "<li class='graella__block--block graella__block--directe'>".__('Directes','contrabanda')."</li>";
        $labels .= "<li class='graella__block--block graella__block--contrabanda'>".__('Reemisions','contrabanda')."</li>";
        $labels .= "<li class='graella__block--block graella__block--podcast'>".__('Podcasts','contrabanda')."</li>";
        $labels .= "<li class='graella__block--block graella__block--contrabanda'>*".__('Quinzenal','contrabanda')."</li>";
        $labels .= "</ul>";

        return $labels; 
        
    } 
?>