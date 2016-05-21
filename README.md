# ExcerciseCode

Assume you have an array of arrays called grant_funding such that:

●	grant_funding[r] contains row r (starting from 0)
●	grant_funding[r][0] contains a unique grantee name (a string, such as “Harvard”)
●	grant_funding[r][1] contains a unique program name (a string, such as “Find More Brains”)
●	grant_funding[r][2] contains a funding amount (a string, such as “2000.35”)

If arrays in your chosen language do not have a member/function to determine the total number of rows, assume it is provided in num_rows. For the purpose of this exercise you can hard code your input in the source file. 

Write a function that displays grant_funding in a simple HTML table, sorted by grantee name, with an extra row for displaying the total funding by program.

For example, the input:

grant_funding = [["UCSD","Find More Brains","1000"],
                 ["UCSD","Drink More Water","130"],
                 ["Harvard","Find More Brains","2000.35"],
                 ["Harvard","Drink More Water","30"]];
num_rows = 4;



