In this task I adapted the website according to requirements:
1) Data is submitted and saved in MySQL database.
2) Success message or Error message in-case of failure appear only after a form submit, instead of validation.
That said, the only thing validated in JavaScript is the checkbox, which disables the submit button until the checkbox is checked.
3) Data (email address validity) is also validated in PHP, instead of JavaScript, located inside Models/Main.php.
Also, I included the additional check whether or not the submitted e-mail is already in the database to avoid duplicates.
4) A page with all the saved data could be accessed by "[project-name]/database", in this case "magebittask3/database".
Or click the "Contact" link to get redirected there.
4.3) Sorting by the name and date is added (in both ascending and descending order).
4.4) It is possible to filter email addresses by email providers, and with every new domain on the list, the new button is created to
show specifically said domain. And said button is removed when the last element with said domain is removed.
4.5) It is possible to search for email addresses and use filters and sorting at the same time.
4.6) It is possible to delete email addresses, by pressing Delete button in each record.

Advantage tasks
1) Selecting multiple emails with checkboxes and exporting them as a CSV file is an implemented feature.
2) This version has no implemented pagination.

To setup the website and view and interact with the database:
1) Import the database located in "database/" directory with the name of "magebit_task.sql". (database/magebit_task.sql)
2) Edit the config file that connects to the database located in "config/" directory with the name of "db_parameters". 
Change the username, password, localhost/server if necessary.

Notes:
1) I haven't used any PHP-frameworks, I only made my own Model-View-Controller framework from scratch and implemented it here.
2) For your information, to test my project I used Open Server and PhpMyAdmin.