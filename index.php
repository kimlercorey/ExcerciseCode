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

Program has been broken up into subcomponents focused on performing descrete functions

inc/data.php - includes the example data input
inc/dataReader.php - reads the data into the pre report data
inc/displayReport.php - function which creates a simple html table sorted by grantee name 
inc/htmlgen.php - just html building features 

*/

require 'inc/data.php';
require 'inc/dataReader.php';
require 'inc/displayReport.php';

 /*
  * Read grant_funding data into results
  *	or dataReader($grant_funding, false); 
  * if you do not wish to calculate totals for data)
  */
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
// Display results
print displayReport(dataReader($grant_funding));
?>
