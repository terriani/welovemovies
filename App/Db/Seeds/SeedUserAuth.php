<?php

//Seed gerada automaticamente via Scooby_CLI em 06-06-20 - 11:57:am
require_once "../../../vendor/autoload.php";

use Scooby\Helpers\Seeders;

$faker = \Faker\Factory::create("pt_BR");

for ($i = 0; $i < 10; $i++) {
    $seeder = new Seeders();
    $seeder->seed("users", [
        "name" => $faker->name,
        "email" => $faker->email,
        "password" => Scooby\Helpers\Login::passwordHash('secret')
    ]);
}
