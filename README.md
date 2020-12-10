## How to start Laravel

-   #### Default setup for new user to test
    -   composer i
    -   npm i
    -   php artisan key:generate
    -   php artisan migrate
    -   php artisan db:seed
-   #### To run default localhost
    -   php artisan serve
-   #### To run with custome port localhost
    -   php artisan serve --port=9999
-   #### To run for the new/added facade
    -   composer dump-autoload

#### Implementation for CV PDF

    -   Must have pdf file in storage\cv\test.pdf.
    -   Must have table to save pdf data.
    -   In web.php,
        - Route::get("test", 'CVFileController@create');

-   #### Test link for CV PDF

    -   http://127.0.0.1:9999/test-cv

-   #### Reference
    -   https://github.com/smalot/pdfparser
    -   https://packagist.org/packages/smalot/pdfparser

## Learning Laravel

    - https://laravel.com/

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
