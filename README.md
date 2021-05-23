How to deploy:

1. composer install;
2. launch your local db server(example: xampp);
3. go to: src/config.php enter your username&pass values and uncomment 10-11 lines && go to bootstrap.php and uncomment 4-10 lines
after that execute 'php -S localhost:8000' in the IDE terminal and go to 'http://localhost:8000/bootstrap.php';
4. go to src/config.php comment lines 10-11, and uncomment 7-8
5. you're ready to go: 'http://localhost:8000/src/view.php' - for main functionality; and:'http://localhost:8000/src/global_stat_view.php' - for the global static.

UPD. To check generated with phpmetrics report go to: 'http://localhost:8000/report/index.html' .