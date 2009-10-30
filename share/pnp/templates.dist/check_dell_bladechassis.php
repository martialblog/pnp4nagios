<?php
#
# PNP4Nagios template for check_dell_bladechassis
# http://folk.uio.no/trondham/software/check_dell_bladechassis.html
#

# Array with different colors
$colors = array("0022ff", "22ff22", "ff0000", "00aaaa", "ff00ff",
    "ffa500", "cc0000", "0000cc", "0080C0", "8080C0",
    "FF0080", "800080", "688e23", "408080", "808000",
    "000000", "00FF00", "0080FF", "FF8000", "800000",
    "FB31FB");

# Color for power usage in watts
$PWRcolor = "66FF00";

# Color for amperage usage in amperes
$AMPcolor = "FFCC00";

# Counters
$count = 0;  # general counter
$v = 0;      # volt probe counter
$a = 0;      # amp probe counter

# Flags
$visited_amp  = 0;
$visited_volt = 0;

# Title
$def_title = 'Dell Blade Enclosure';

# loop through the performance data
foreach ($DS as $i) {
    
    # Total Wattage
    if(preg_match('/^total_watt/',$NAME[$i]) && $UNIT[$i] == 'W') {
        $NAME[$i] = 'Total Power Usage';
        
        ++$count;
        $ds_name[$count] = "Total Power Consumption";
        $vlabel = "Watt";
        
        $title = $ds_name[$count];
        
        $opt[$count] = "--slope-mode --vertical-label \"$vlabel\" --title \"$def_title: $title\" ";
        
        $def[$count] = "DEF:var$i=$rrdfile:$DS[$i]:AVERAGE " ;
        $def[$count] .= "AREA:var$i#$PWRcolor:\"$NAME[$i]\" " ;
        $def[$count] .= "LINE:var$i#000000: " ;
        $def[$count] .= "GPRINT:var$i:LAST:\"%6.0lf $UNIT[$i] last \" ";
        $def[$count] .= "GPRINT:var$i:MAX:\"%6.0lf $UNIT[$i] max \" ";
        $def[$count] .= "GPRINT:var$i:AVERAGE:\"%6.2lf $UNIT[$i] avg \\n\" ";
    }
    
    # Total Amperage
    if(preg_match('/^total_amp/',$NAME[$i]) && $UNIT[$i] == 'A') {
        $NAME[$i] = 'Total Current';
        
        ++$count;
        $ds_name[$count] = "Total Amperage";
        $vlabel = "Ampere";
        
        $title = $ds_name[$count];
        
        $opt[$count] = "-X0 --slope-mode --vertical-label \"$vlabel\" --title \"$def_title: $title\" ";
        
        $def[$count] = "DEF:var$i=$rrdfile:$DS[$i]:AVERAGE " ;
        $def[$count] .= "AREA:var$i#$AMPcolor:\"$NAME[$i]\" " ;
        $def[$count] .= "LINE:var$i#000000: " ;
        $def[$count] .= "GPRINT:var$i:LAST:\"%4.2lf $UNIT[$i] last \" ";
        $def[$count] .= "GPRINT:var$i:MAX:\"%4.2lf $UNIT[$i] max \" ";
        $def[$count] .= "GPRINT:var$i:AVERAGE:\"%4.4lf $UNIT[$i] avg \\n\" ";
    }
    
    # Voltage per PSU
    if(preg_match('/^volt_/',$NAME[$i])){
        if ($visited_volt == 0) {
            ++$count;
            $def[$count] = "";
            $visited_volt = 1;
        }
        
        $NAME[$i] = preg_replace('/^volt_ps(\d+)/', 'PowerSupply $1', $NAME[$i]);
        
        $ds_name[$count] = "PS Voltage";
        $vlabel = "Volt";
        
        $opt[$count] = "-X0 --slope-mode --vertical-label \"$vlabel\" --title \"$def_title: Power Supply Voltage\" ";
        
        $def[$count] .= "DEF:var$i=$rrdfile:$DS[$i]:AVERAGE " ;
        $def[$count] .= "LINE:var$i#".$colors[$v++].":\"$NAME[$i]\" " ;
        $def[$count] .= "GPRINT:var$i:LAST:\"%3.2lf $UNIT[$i] last \" ";
        $def[$count] .= "GPRINT:var$i:MAX:\"%3.2lf $UNIT[$i] max \" ";
        $def[$count] .= "GPRINT:var$i:AVERAGE:\"%3.2lf $UNIT[$i] avg \\n\" ";
    }
    
    # Amperage per PSU
    if(preg_match('/^amp_/',$NAME[$i])){
        if ($visited_amp == 0) {
            ++$count;
            $def[$count] = "";
            $visited_amp = 1;
        }
        
        $NAME[$i] = preg_replace('/^amp_ps(\d+)/', 'PowerSupply $1', $NAME[$i]);
        
        $ds_name[$count] = "PS Amperage";
        $vlabel = "Ampere";
        
        $opt[$count] = "-X0 --slope-mode --vertical-label \"$vlabel\" --title \"$def_title: Power Supply Amperage\" ";
        
        $def[$count] .= "DEF:var$i=$rrdfile:$DS[$i]:AVERAGE " ;
        $def[$count] .= "LINE:var$i#".$colors[$a++].":\"$NAME[$i]\" " ;
        $def[$count] .= "GPRINT:var$i:LAST:\"%2.3lf $UNIT[$i] last \" ";
        $def[$count] .= "GPRINT:var$i:MAX:\"%2.3lf $UNIT[$i] max \" ";
        $def[$count] .= "GPRINT:var$i:AVERAGE:\"%2.3lf $UNIT[$i] avg \\n\" ";
    }
    
}
?>
