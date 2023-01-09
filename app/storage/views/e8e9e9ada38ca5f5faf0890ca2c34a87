<?php 
function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "il y a 30 seconds";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "il y a 1 minutes";
        }
        else{
            return "il y a $minutes minutes";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "il y a 1 heurs";
        }else{
            return "il y a $hours heurs";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "il y a 1 jour";
        }else{
            return "il y a $days jours";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "il y a 1 semaines";
        }else{
            return "il y a $weeks semaines";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "il y a 1 mois";
        }else{
           return "il y a $months mois";
        }
    }
    //Years
    else{
        if($years==1){
            return "il y a 1 annee";
        }else{
            return "il y a $years ans";
        }
    }
}
?>