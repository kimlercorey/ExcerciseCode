<?php

require_once 'inc/htmlgen.php';

/**
 * @method String displayReport(array $data)
 * 
 * note:  $data input format expected is
 * 
 *		  array(n) { ["grantee_name"]=> array(n) { ["program_name"]=> float(x) }}
 */
function displayReport(array $data)
{

    $total = $program_names = [];
    $header = $body = $footer = null;

    // Sort the data by alpha DESC on keyname
    ksort($data);

    // Process each grantee
    foreach($data as $grantee => $programs) {

    	$line = [];
        $program_names = $programs; //i.e. store keys - "Find More Brains", "Drink More Water"
    	
    	// Process each program_name
    	foreach($programs as $program_amount) {
        	array_push($line, $program_amount);
        }

        // Send each line to builder unless it is a total line item 
        ($grantee != "Total") ? $body.= tableBuilder($grantee, $line[0], $line[1]) : $total = $line;
        
    }

    //process header for program names
    $header .= tableHeader($program_names);

    // include totals line if it was included in the data
    if ($total) $body .= tableBuilder("Total", $total[0], $total[1]);

    // return the entirty of html table
    return $header . $body . $footer;
}

?>