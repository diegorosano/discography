# Discography "period" checker

This project was made for a discography that needed to keep track of how much a song was listened on different platforms like Spotify.

##Code features
This is basically a project full of CRUD's, it has some ajax calls to populate some fields in some sections.
One of the things i liked is that it have a (not so good coded, and a lot of copy paste from different sites) pagination manager for custom search.

##Getting started
This guide will help you to get a working copy of the project.

###Prerequisites
``Server requirements to run Laravel v5.2 - https://laravel.com/docs/5.2``

``Composer - https://getcomposer.org/download/``

###Installing
Open a new terminal and go to the project folder, then update composer.

``composer update``

All the files needed to run the project will be updated.

Generate new project key

``php artisan key:generate``

Now go and edit the .env file and update your MySQL server data. After this, in the command line window, run the migrate command

``php artisan migrate``

You should have now a working copy of the project.

##Notes from the author
- This project is in spanish.

- This project was never deployed to a live server. 

- When i did this, i was a Jr. in Laravel and PHP.