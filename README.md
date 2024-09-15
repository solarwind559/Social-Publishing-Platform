**Make sure you have git installed on your computer.**
**Open the terminal and navigate to a folder where you want to save this project.**
**Run command:**  
``git clone https://github.com/solarwind559/Social-Publishing-Platform.git``

**Navigate to the project directory and run commands:**  
``composer install``
``npm install``

**Duplicate .env.example file and rename it to .env.**
**Create a database locally and edit the .env file to match your local database details**
**Run commands:**  
``php artisan key:generate``  
``php artisan migrate``  
``php artisan db:seed``  
``php artisan serve``  
``npm run dev``  

**Follow link from artisan serve to view the page**

Only registered users can view portal.

A registered user can:
- create a profile, log out and log in again
- edit and visit own public profile
- view all posts by all users with newest posts first
- sort posts by categories
- filter posts by keywords
- visit post to read more and see comments
- add a comment to a post, edit and delete it
- create a new post, edit and delete it
- visit another user's profile and see all posts by the user
- visit page to view all own posts created with newest posts first

