# Cyber-Duck Laravel task

Back-end: Laravel 

Front-end: Vue Js

Steps to setup:

    composer install 
    cp .env.example .env
    php artisan key:generate
    php artisan migrate:fresh --seed
    npm install

To run the project have to call both of this command at a time with different terminal:

    npm run watch
    php artisan serve

Task testing proof: https://www.loom.com/share/410631b1bef74b95877f18e5b2dcf31d


To run test case, run it one by one like:

    php artisan test --filter RecordSaleTest
    php artisan test --filter GetSaleTest
    php artisan test --filter NewShippingTest
    php artisan test --filter GetShippingTest
    Test cases testing proof: https://www.loom.com/i/c50fcbcfadf84067b9ca9a46cf0f69b7
