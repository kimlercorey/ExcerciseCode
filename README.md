# ExcerciseCode

Assume you have an array of arrays called grant_funding such that:

* grant_funding[r] contains row r (starting from 0)
* grant_funding[r][0] contains a unique grantee name (a string, such as “Harvard”)
* grant_funding[r][1] contains a unique program name (a string, such as “Find More Brains”)
* grant_funding[r][2] contains a funding amount (a string, such as “2000.35”)

If arrays in your chosen language do not have a member/function to determine the total number of rows, assume it is provided in num_rows. For the purpose of this exercise you can hard code your input in the source file. 

Write a function that displays grant_funding in a simple HTML table, sorted by grantee name, with an extra row for displaying the total funding by program.

For example, the input:

	grant_funding = [["UCSD","Find More Brains","1000"],
                 ["UCSD","Drink More Water","130"],
                 ["Harvard","Find More Brains","2000.35"],
                 ["Harvard","Drink More Water","30"]];
	num_rows = 4;

[See live solution run here...](http://kimler.com/ExerciseCode "Live version")

Sample data results in:

|                    | Find More Brains  | Drink More Water  |
| :------------------|------------------:|------------------:|
| Harvard            | 2000.35	         |            30.00  |
| UCSD               | 1000.00           |           130.00  |
| Total              | 3000.35           |   160.00          |

## Approach

As opposed to utilizing any external libraries or writing a reporting framework, this solution will focus on directly processing the data. This can be done in two steps: 1. processing the input data (and totalling the programs) and 2. Presenting the table. Additionally, since this is more so to facilitate a conversation about approach, the solution is not utilizing namespaces or classes but we can certainly go there is it would provide needed insight to capabilities.

## Included Files

### data.php 
This is simply the input array. Although I checked the program with additional inputs (Grantees and Programs) this was not committed nor were unit tests written for the code.

### dataReader.php 
This reads in the data from the data array and totals each program. Additionally, it reformats the data to make it more easily accessible (i.e. $data[grantee][program] => amount) 

### displayReport.php
This sorts the data, extracts the program names and compiles each row so that it can be then presented. It also contains some logic so that the 'total' line is processed then presented as last line dispite where it is in the data.

### htmlgen.php 
This file has a few routines to generate the table html (header, rows and footer). It is not meant to be extensive as in a larger envirnment there are generally libraries we would be using for most of these capabilities.

### index.php
This includes all the above files, has some sample css to the table looks as requesed and makes the actual request to displayReport using the data consumed by dataReader.

## Final Notes

So that we can finalize our direction I am making the php version (with no frills) avaiable quickly (after about 4 hours working on this) but I can create a more robust version or Node version if it would be helpful. I can also include any other features if it would be helpful like:

* Unit tests
* Version using namespaces and classes 
* Node-centric version
* Additional Error checking
* Feature to allow multiple entries for a grantee/program name 
* Feature for pagination (probably the simpliest way would be using one of the jquery auto-magic ones) but the approach could also be handled from the server-side if needed.
* Any other features that would be good to see


