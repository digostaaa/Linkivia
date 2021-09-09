# Linkivia
Linkivia Tickets

this is a little challenge that i completed

1. clone this 
2. install dependecies: composer install
3. make migrations: php bin/console d:m:m
4. make Fixtures: php bin/console d:f:l --no-interaction
5. run server


the fixture will load a user ('user', 'user') and an admin ('linkivia', 'linkivia) or you can make your own via .../registration | .../adminregistration

there is an admin dashboard in .../admin

if you are using an API program, in the header section, be sure to do this key= Content-Type  Value = application/json
