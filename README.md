# Linkivia
Linkivia Tickets

this is a little challenge that i completed

1. clone this 
2. install dependecies: composer install
3. make migrations: php bin/console d:m:m
4. make Fixtures: php bin/console d:f:l --no-interaction
5. run server

php -v 7.2.5
Symfony -v 5.^

the fixture will load a user ('user', 'user') and an admin ('linkivia', 'linkivia) or you can make your own user via .../register

there is an admin dashboard in .../admin
if you want to add a user from the admin dashboard you'll have to encode the password first with the command php bin/console security:encode-password and past the encoded password in the respected field

if you are using an API program, in the header section, be sure to do this key = Content-Type  Value = application/json


the path for the api is .../api/tickets and .../api/replies and the swagger is .../api
