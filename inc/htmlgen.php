<?php

/**
 * @method String tableBuilder(String $grantee, String $program, String $amount)
 */
function tableBuilder($grantee, $program_names, $data)
{
	//var_dump($data);
    $str = "<tr>\n";
    $str.= "  <td>$grantee </td>\n";

    foreach($program_names as $k => $program) {

    	if (isset($data[$grantee][$k])) {
        $str.= "  <td> ". money_format('%.2n', $data[$grantee][$k]) ."</td>\n";
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