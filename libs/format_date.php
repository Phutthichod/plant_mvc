<?php
function dmy_TO_ymd($date)
{
    $temp =explode("/",$date);
    if(sizeof($temp) > 1)
    return $temp[2]."-".$temp[1]."-".$temp[0];
    else
    return $date;
}
function ymd_TO_dmy($date)
{
    $temp =explode("-",$date);
    if(sizeof($temp) > 1)
    return $temp[2]."/".$temp[1]."/".$temp[0];
    else
    return $date;
}