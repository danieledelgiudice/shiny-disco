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
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
    $faker->addProvider(new Faker\Provider\it_IT\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Company($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Internet($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Payment($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Text($faker));

    return [
        'nome' => $faker->firstName($sex ? 'male' : 'female'),
        'cognome' => $faker->lastName,
        'sesso' => ($sex ? 1 : 2),
        'data_nascita' => $faker->date(),
        'citta_nascita' => $faker->state,
        'codice_fiscale' => $faker->taxId,
        'via' => $faker->streetAddress,
        'citta_residenza' => $faker->state,
        'provincia' => $faker->stateAbbr,
        'cap' => substr($faker->postcode, 0, 5),
        'cellulare' => $faker->e164PhoneNumber,
        'telefono' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,
        'fax' => $faker->tollFreePhoneNumber,
        'partita_iva' => $faker->iban('IT'),
        'tipo_documento' => $faker->randomElement(['Patente', 'Carta d\'Identità', 'Passaporto']),
        'numero_documento' => $faker->creditCardNumber,
        'stato_civile' => $faker->numberBetween(0, 3),
        'reddito' => $faker->numberBetween(2000, 50000),
        'numero_card' => $faker->creditCardNumber,
        'note' => $faker->text,
    ];
});