<?php
function DB_toGenome($dna)
{   $ss ="";
    $Genome_ss=null;
    $key_data = ["A" => "A", "B" => "T", "C" => "C", "D" => "G", "E" => "A,T", "F" => "A,C", "G" => "A,G", "H" => "T,C", "I" => "T,G", "J" => "C,G", "K" => "A,T,C", "L" => "A,T,G", "M" => "A,C,G", "N" => "T,C,G", "O" => "A,T,C,G"];
    if (isset($dna) && !empty($dna)) {
         for($i =0;$i<strlen($dna);$i++)
            {
                $ss .= $key_data[$dna[$i]]."@";
            }
            $Genome_ss=substr($ss, 0, -1);
            return $Genome_ss;
    } else
        return false;
}
function Genome_toDB($dna)
{
    $ss="";
    
    $key_data = ["A" => "A" ,"T" => "B" ,"C" => "C" ,"G" => "D" ,"A,T" => "E" ,"T,A" => "E","A,C" => "F" ,"C,A" => "F","A,G" => "G" ,"G,A"=>"G","T,C" => "H" 
    ,"C,T"=>"H","T,G" => "I" ,"G,T" => "I" ,"C,G"=>"J","G,C"=>"J","A,T,G" => "L" ,"A,T,C" => "K","A,C,T" => "K","A,C,G"=>"M","A,G,T"=>"L","A,G,C"=>"M"
    ,"T,A,C" =>"K" ,"T,A,G" => "L","T,C,A"=>"K","T,C,G"=>"N","T,G,A"=> "L","T,G,C"=> "N","C,A,T"=>"K","C,A,G"=>"M","C,T,A"=>"K","C,T,G"=>"N","C,G,A"=>"M","C,G,T"=>"N"
    ,"G,A,T"=>"L","G,A,C"=>"M","G,T,A"=>"L","G,T,C"=>"N","G,C,A"=>"M","G,C,T"=>"N"];
    $temp = explode("@",$dna);
   
    if (isset($dna) && !empty($dna)) {
        if(sizeof($temp) > 2)
        {
            for($i=0;$i<sizeof($temp);$i++)
            {
                $ss .= $key_data[$temp[$i]];
            }
        }
        else
        {
            
            if(isset($temp[1]))
            {
                if(!empty($temp[1]))
                {
                    $ss = $key_data[$temp[0]].$key_data[$temp[1]];
                }
                else
                {
                    $ss = $key_data[$temp[0]];
                }
            }
        }
        if($ss == "")
        {
            $ss = null;
        }
        return $ss;
    }
    else
        return false;
}