# EcoRide-project

1. create new database with name "ecoride_french".

2. add credentials in "auth.php" and "conn.php"

3. create a new folder "ecoride" inside htdocs folder and put all the folders and files inside it.

4. open browser and write the url "/ecoride" to access the project.

user register his account
if he choose driver type then he will be redirected to "add cardpool" where he can add carpools, see history of all his carpools and can cancel a carpool

if he choose customer type then he will be redirected to "search carpool" where he can enter places and date to seach for carpools, if search finds matching data then it will show below in results section with a detail button. by clicking on detail button he will be redirected to see the carpool details and an input to enter number of seats and a button "book now". by clicking on the book now, the booking takes which subtracts the number of seats from carpool and also subtracts the credit from the customer.

after booking he will be redirected to a booking page where he can write review and rate the driver. also he can cancel the booking. upon cancelling the credit will be added back to his account and seats back to carpool.

if driver cancel the carpool, credit goes back to all the passengers and email is sent.