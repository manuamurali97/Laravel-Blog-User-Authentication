# Laravel-Blog-User-Authentication
A simple Laravel project demonstrating user authentication and blog post management. Users can register, log in, create/edit/delete posts, and view all posts.

It allows users to:

Register and log in using a name, email, and password.

Create, edit, and delete their own blog posts.

View all posts by all users.

Log out securely.

The project implements basic security measures, including hashed passwords, input validation, and authorization checks to ensure only post owners can edit/delete their posts.

Features:
1. User Authentication

Registration: Users can register with a unique name and email.

Login: Users can log in with their credentials.

Logout: Users can securely log out.

Auth Middleware: Protects routes so only logged-in users can create/edit/delete posts.

2. Blog Post Management

Create Post: Users can create a new post with a title and body.

Edit Post: Users can edit only their own posts.

Delete Post: Users can delete only their own posts.

Post Listing: Displays all posts for guests; logged-in users see their posts plus all posts.

Sanitization: Input is sanitized to prevent XSS attacks.

3. Blade Templates

home.blade.php: Main page for registration, login, and posts display.

edit-post.blade.php: Edit form for posts.

Dynamic content rendering based on authentication (@auth and @else directives).

4. Eloquent Relationships

User has many Posts (posts() relationship).

Post belongs to User (user() relationship).

Proper foreign key handling with user_id.

5. Validation & Security

Form input validation using Laravel's validate() method.

Passwords are hashed using bcrypt().

Authorization checks prevent unauthorized editing or deletion of posts.
