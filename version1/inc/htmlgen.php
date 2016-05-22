<?php

/**
 * @method String tableBuilder(String $grantee, String $program, String $amount)
 */
function tableBuilder($grantee, $program, $amount)
{
    $str = "<tr>";
    $str.= "<td>$grantee </td>";
    $str.= "<td>" . money_format('%.2n', $program) . "</td>";
    $str.= "<td>" . money_format('%.2n', $amount) . "</td>";
    $str.= "</tr>";
    return $str;
}

/**
 * @method String tableHeader(array &$program_names)
 */
function tableHeader(array & $program_names)
{
    $str = " ";
    $str.= "<table border='1'><tr>";
    $str.= "<td width='200px'> </td>";
    foreach($program_names as $k => $program) {
        $str.= "<td width='200px'> $k </td>";
    }

    $str.= "</tr>";
    return $str;
}

/**
 * @method String tableFooter(void)
 */
function tableFooter()
{
    return " </table>";
}

?>