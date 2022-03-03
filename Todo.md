# POS app features

- it has inventory for stock. Each time an item is clicked on the quantity reduces
- Access control for admins to view orders and manage inventory
- Sorting and order filtering by date
- Export data to CSV format

- Used phpdesktop to put software in a container to run on windows OS.
- OOP PHP with MVC architecture for logic and access control for users
- SQLITE for managing database relationship
- Javascript and AJAX for smooth UX functionality
- Charts to view data
- Bootstrap for UI design

- Core will contain the main files and routes
- index page will be our router where it finds the controller and loads the right view file

> Info: avoid closing the php tags on the class file because it generates an error as it's going to read it as HTML. That occurs when u try to redirect a page because the headers have already been sent

> The routing system is for scalability in case you intend to increase the amount of pages on the website

## Design view pages
- add home view

*Database tables*

- Products 
description
barcode
qty
amount
image
views
user_id
date

- users
username
name
email
pwd
role
date
image

- sales
user_id
barcode
receipt_no
description
qty
amount
total
date

- design cart ui
- add checkout ui

## Database 
> SQLite is good on a single user app which can only be accessed by a single user
- Used to store data locally
- Adding indexes on columns help you to search the database
- OOP

- insert data into db
- input validation

- Sessions: it is a way which websites recognize the user
Always have the keyword `session_start()`

- hash pwd: password hash uses a salt that's used to encrypt the pwd. It's a one way encryption algorithm
- use password_verify to check login pwds
