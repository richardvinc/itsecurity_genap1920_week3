<?php
$password = "test";
$options = ['cost' => 12];
$hash = password_hash($password,  PASSWORD_BCRYPT, $options);

echo $hash . "<br/>";

echo password_verify($password, '$2y$10$MyUBKxz0ihu2FzNeXf/4auRo7XVhxdTXhWEdjXe/iRO3JyOYvbUdG');


// $2a$05$CpLbXwCEg5PVz1RXjyfqZ.2aort8/h2P9KBLYVg8331aqaweK2iDW
// $2y$10$KM4zeD01mjXimBl1o8BFJuQx6YKU1i0tZ8.cUPyFxXQNcuWpxYBC6
