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

