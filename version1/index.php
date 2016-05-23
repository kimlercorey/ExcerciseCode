<?php
/*
@title:  Code Excercise
@author: Kimler (KC) Corey

Assume you have an array of arrays called grant_funding such that:

●	grant_funding[r] contains row r (starting from 0)
●	grant_funding[r][0] contains a unique grantee name (a string, such as “Harvard”)
●	grant_funding[r][1] contains a unique program name (a string, such as “Find More Brains”)
●	grant_funding[r][2] contains a funding amount (a string, such as “2000.35”)

If arrays in your chosen language do not have a member/function to determine the total number of rows, assume it is provided in num_rows. For the purpose of this exercise you can hard code your input in the source file. 

Write a function that displays grant_funding in a simple HTML table, sorted by grantee name, with an extra row for displaying the total funding by program.

* * *

This is the single file version in the instance that text version as single file is requested

*/


// This is the original data provided to include for processing
$grant_funding = [
	["UCSD", "Find More Brains", "1000"], 
	["UCSD", "Drink More Water", "130"], 
	["Harvard", "Find More Brains", "2000.35"], 
	["Harvard", "Drink More Water", "30"]
];

$num_rows[] = 4;
?>


<!-- example css --> 
<style>

table.main {
    border-collapse: collapse;
    border-color: grey;
    font-family: 'Arial', 'Helvetica';
    border: 1px solid black;
    padding: 3px;
}

.main td {
	width: 220px;
	padding: 3px;
}

.main tr:hover {
	background-color: yellow;
}

.main thead td{
    text-align: center;
}

.alpha {
	text-align: left;
}

.numeric {
	text-align: right;
}

</style>



<?php

print displayReport(dataReader($grant_funding));


/**
 * @method array dataReader(array $data, bool calculateTotals)
 */

function dataReader(array $data, $calculateTotals = true)
{

    $programTotalled = $results = [];

    // Process each item in the input array
    // expects [ String grantee, String program_name, String|float amount]
    foreach($data as $values_arr) {

        // break out just for convenience in example
        $grantee_name = $values_arr[0];
        $program_name = $values_arr[1];
        $funding_amount = floatval($values_arr[2]);

        // Data format for funding processed is:
        // Results[Grantee][program] = amount

        /* todo: !ASSUMPTION - data has been scrubbed down to one grantee/program listing per line
        If there is isnt an entry for the school already - we may want to change that.
        */

        // If this grantee has not been added to the results array, then add it
        if (!array_key_exists($grantee_name, $results)) $results[$grantee_name] = [];

        // Create an entry for each $program_name with $funding_amount in each $grantee_name
        $results[$grantee_name][$program_name] = $funding_amount;

        // If totals need to be included then track and create entry
        if ($calculateTotals) {
            if (!array_key_exists("$program_name", $programTotalled)) {
                $programTotalled[$program_name] = [];
                $results['Total'][$program_name] = $funding_amount;
            }
            else {
                $results['Total'][$program_name]+= $funding_amount;
            }
        }
    }

    return $results;
}

/**
 * @method String tableBuilder(String $grantee, String $program, String $amount)
 */
function tableBuilder($grantee, $program_names, $data)
{
	//var_dump($data);
    $str = "<tr>\n";
    $str.= "  <td class='alpha'>$grantee </td>\n";

    foreach($program_names as $k => $program) {

    	if (isset($data[$grantee][$k])) {
        $str.= "  <td class='numeric'> ". money_format('%.2n', $data[$grantee][$k]) ."</td>\n";
    	} else {
    		$str.= "  <td> 0.00</td>\n";
    	}
    }
    $str.= "</tr>\n";
    return $str;
}

/**
 * @method String tableHeader(array $program_names)
 */
function tableHeader(array $program_names)
{
    $str = "\n";
    $str.= "<table border='1' id='example1' class='main'>\n<thead>\n<tr>\n";
    $str.= "  <td> </td>\n";
    foreach($program_names as $k => $program) {
        $str.= "  <td> $k </td>\n";
    }

    $str.= "</tr>\n</thead>\n<tbody>\n";
    return $str;
}

/**
 * @method String tableFooter(void)
 */
function tableFooter()
{
    return " </tbody>\n</table>\n";
}


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
    
    // Read though data - get all unigue program_names
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

 /*
  * Read grant_funding data into results
  *	or dataReader($grant_funding, false); 
  * if you do not wish to calculate totals for data)
  */
?>