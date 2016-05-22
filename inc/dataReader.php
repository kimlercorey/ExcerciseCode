<?php
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

        // If this school has not been added to the results array, then add it
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

?>