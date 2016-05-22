<?php

require_once 'inc/htmlgen.php';

/**
 * @method void displayReport(array $data)
 */
function displayReport(array $data)
{
    $total = array();
    $program_names = array();
    $header = $body = $footer = null;

    // Sort the data by alpha DESC on keyname
    ksort($data);

    // Process each datum
    foreach($data as $k => $values_arr) {
        $line[] = $k;

        // total needs seperate processing
        if ($k == "Total") {
            $program_names = $values_arr;
            array_push($total, $k);
            foreach($values_arr as $key => $val) {
                array_push($line, $val);
            }

            // Store total line in $total for processing later
            $total[0] = $line[0];
            $total[1] = $line[1];
            $total[2] = $line[2];
        }
        else {
            foreach($values_arr as $ke => $va) {
                array_push($line, $va);
            }

            // send to html builder
            $body.= tableBuilder($line[0], $line[1], $line[2]);
        }

        unset($line);
    }

    $header.= tableHeader($program_names);
    $body.= tableBuilder($total[0], $total[1], $total[2]);
    print $header . $body . $footer;
}

?>