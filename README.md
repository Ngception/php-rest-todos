![php](https://miro.medium.com/max/1050/1*TrVpYovCjQBDzfHsjwNODA.jpeg)

# PHP REST TODOS API

A learning exercise in writting a basic REST API using PHP as a beginner without any libraries or frameworks.

Currently, performs basic CRUD operations to create, fetch, update, and delete with mock data provided from a SQL seed file.

## Setup
Uses [XAMPP](https://www.apachefriends.org/) Apache distribution that includes MariaDB, PHP, and Perl.

For development with hot reloading, uses the [VSCode Live Server extension](https://marketplace.visualstudio.com/items?itemName=ritwickdey.LiveServer) in conjunction with the [Live Server web extension](https://chrome.google.com/webstore/detail/live-server-web-extension/fiegdmejfepffgpnejdinekhfieaogmj?hl=en-US).

To connect to the database, credentials are provided through environment variables to `src/api/config/Database.php` as well as `src/api/models/Todo.php`

## Testing
Uses [phpunit](https://phpunit.de/) for basic unit testing.

Run `make run-tests` to run all tests in `test/` directory.
## Usage
All requests can be made to `http://localhost/php-rest-todos/src/api/*.php`
