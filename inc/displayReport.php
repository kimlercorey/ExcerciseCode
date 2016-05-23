<?php

require_once 'inc/htmlgen.php';

/**
 * @method String displayReport(array $data)
 * 
 * note:  $data input format expected is
 * 
 *		  array(n) { ["grantee_name"]=> array(n) { ["program_name"]=> float(x) }}
 */
function displayReport($data)
{

    $total = $program_names = [];
    $header = $body = $footer = null;

    // Sort the data by alpha DESC on keyname (grantee)
    ksort($data);
    
    // Read though data - get all unigue names
    $program_names = getProgramsFromGrantee($data);

    // Process each grantee
    foreach($data as $grantee => $programs) {

    	$line = [];
    	
    	// Process each program_name
    	foreach($programs as $program_name => $program_amount) {
        	array_push($line, $program_amount);

        	// Add any new program names to list of names
        	if (!isset($program_names[$program_name])) $program_names[$program_name] = 1;
        }

        // Set any null amounts to 0
        if (!isset($line[1])) $line[1] = '0.00';

        // Save total line items for later otherwise use it
        ($grantee != "Total") ? $body.= tableBuilder($grantee, $program_names, $data) : $total = $line;
        
    }

    // Process header for program names
    $header .= tableHeader($program_names);

    // Include totals line if it was included in the data
    if ($total) $body .= tableBuilder("Total", $program_names, $data);

    $footer = tableFooter();

    // return the entirety of html table
    return $header . $body . $footer;
}


/**
 * @method Array getProgramsFromGrantee(array $arr)
 * 
 * Returns a list of program names in $arr
 */
function getProgramsFromGrantee($arr) 
{
	$programs = [];

	foreach( $arr as $grantee ) {
		foreach( array_keys($grantee) as $program ) {   
			$programs[$program] = true;
		}
	}
	
	return $programs;
}


?>