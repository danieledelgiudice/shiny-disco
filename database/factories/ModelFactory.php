<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Cliente::class, function (Faker\Generator $faker) {
    $sex = $faker->boolean;
    return [
        'nome' => $faker->firstName($sex ? 'male' : 'female'),
        'cognome' => $faker->lastName,
        'sesso' => ($sex ? 'male' : 'female'),
        'data_nascita' => $faker->date(),
        'citta_nascita' => $faker->city,
        'codice_fiscale' => $faker->swiftBicNumber,
        'via' => $faker->address,
        'citta_residenza' => $faker->city,
        'provincia' => $faker->stateAbbr,
        'cap' => substr($faker->postcode, 0, 5),
        'cellulare' => $faker->e164PhoneNumber,
        'telefono' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,
        'fax' => $faker->tollFreePhoneNumber,
        'partita_iva' => $faker->iban('it_IT'),
        'tipo_documento' => $faker->randomElement(['Patente', 'Carta d\'Identità', 'Passaporto']),
        'numero_documento' => $faker->creditCardNumber,
        'stato_civile' => $faker->numberBetween(0, 3),
        'reddito' => $faker->numberBetween(2000, 50000),
        'numero_card' => $faker->creditCardNumber,
        'note' => $faker->text,
    ];
});