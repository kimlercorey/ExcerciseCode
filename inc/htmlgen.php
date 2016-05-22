<?php

/**
 * @method String tableBuilder(String $grantee, String $program, String $amount)
 */
function tableBuilder($grantee, $program, $amount)
{
    $str = "<tr>\n";
    $str.= "  <td>$grantee </td>\n";
    $str.= "  <td>" . money_format('%.2n', $program) . "</td>\n";
    $str.= "  <td>" . money_format('%.2n', $amount) . "</td>\n";
    $str.= "</tr>\n";
    return $str;
}

/**
 * @method String tableHeader(array &$program_names)
 */
function tableHeader(array & $program_names)
{
    $str = "\n";
    $str.= "<table border='1'>\n<tr>\n";
    $str.= "  <td width='200px'> </td>\n";
    foreach($program_names as $k => $program) {
        $str.= "  <td width='200px'> $k </td>\n";
    }

    $str.= "</tr>\n";
    return $str;
}

/**
 * @method String tableFooter(void)
 */
function tableFooter()
{
    return "</table>\n";
}

?>