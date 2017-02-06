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
        'data_nascita' => $faker->dateTimeThisDecade(),
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
        'tipo_documento' => $faker->numberBetween(0, 5),
        'numero_documento' => $faker->creditCardNumber,
        'stato_civile' => $faker->numberBetween(0, 6),
        'reddito' => $faker->numberBetween(2000, 50000),
        'numero_card' => $faker->creditCardNumber,
        'note' => $faker->text,
        
        'filiale_id' => App\Filiale::all()->random()->id,
        'professione_id' => App\Professione::all()->random()->id
    ];
});

    
    $factory->define(App\Pratica::class, function (Faker\Generator $faker) {
        $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
        $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
        $faker->addProvider(new Faker\Provider\it_IT\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\it_IT\Company($faker));
        $faker->addProvider(new Faker\Provider\it_IT\Internet($faker));
        $faker->addProvider(new Faker\Provider\it_IT\Payment($faker));
        $faker->addProvider(new Faker\Provider\it_IT\Text($faker));
        
        $modelliAuto = [
            // English
            'Aston Martin DB7',
            'Aston Martin DB9',
            'Aston Martin Vanquish',
            'Bentley Continental GT',
            'Bentley Continental GTC',
            'Bentley Mulsanne2010',
            'Jaguar XJR-15',
            'Jaguar S-Type',
            'Jaguar F-Type',
            // French
            'Citroën Traction Avant',
            'Citroën Berlingo',
            'Citroën C-Crosser',
            'Citroën DS4',
            'Citroën C-ZERO',
            'Citroën C1',
            'Citroën C4 Picasso',
            'Peugeot 107',
            'Peugeot 208',
            'Peugeot 408',
            'Peugeot 508',
            'Peugeot RCZ',
            'Peugeot 4007',
            'Peugeot Expert Tepee',
            'Renault Megane',
            'Renault Clio',
            'Renault Kangoo',
            'Renault Laguna Coupe',
            'Renault Master',
            'Renault Twingo',
            'Renault Twizy',
            'Renault Symbol',
            'Renault Koleos',
            // German
            'Audi A1',
            'Audi A4',
            'Audi A5',
            'Audi A6',
            'Audi A7',
            'Audi A8',
            'Audi TT',
            'Audi R8',
            'Audi Q3',
            'Audi Q5',
            'Audi Q7',
            'BMW E24',
            'BMW M3',
            'BMW M5',
            'BMW Z4 Roadster',
            'BMW X6M',
            'Mercedez Class A',
            'Mercedez Class B',
            'Mercedez Class C',
            'Mercedez Class D',
            'Mercedez Class E',
            'Mercedez Class S',
            'Opel Meriva',
            'Opel Astra',
            'Opel Corsa',
            'Opel Zafira',
            'Opel Omega',
            'Opel Calibra',
            'Opel Vectra',
            'Volkswagen Beetle',
            'Volkswagen Golf',
            'Volkswagen Polo',
            'Volkswagen Touran',
            'Volkswagen Sharan',
            'Volkswagen Santana',
            'Volkswagen Lavida',
            // Italian
            'Fiat 500',
            'Fiat Bravo',
            'Fiat Croma',
            'Fiat Grande Punto',
            'Fiat Idea',
            'Fiat Weekend',
            'Fiat Panda',
            'Alfa Romeo Mi.To',
            'Alfa Romeo Giulietta',
            'Alfa Romeo 159',
            // Sweden
            'Saab 9-3 Berline de Sport',
            'Saab 9-3 Cabriolet II',
            'Saab 9-3 Sport-Hatch',
            'Saab 9-3X, crossover',
            'Saab 9-5 II Berline',
            'Saab 9-5 II Estate Break',
            'Saab 9-4X',
        ];
    
        $tipologieIntervento = [
            'Lesioni',
            'Lesioni e mezzo',
            'Lesioni e cose',
            'Danni al mezzo',
            'RCA lesioni',
            'Cose',
            'Polizza infortuni',
            'RCT',
            'Risarcimento lesioni',
            'Danni a cose',
            'Lesioni a persona',
            'Morte',
        ];
        
        $dinamiche = [
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'La controparte non rispettava una precedenza',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo tamponato dalla controparte',
            'Venivo investito sulle strisce pedonali',
            'Venivo investito sulle strisce pedonali',
            'Venivo investito sulle strisce pedonali',
            'Venivo investito sulle strisce pedonali',
            'Malasanità',
            'Recupero crediti',
            'Tamponamento a catena',
        ];
        
    $cliente = App\Cliente::all()->random();

    return [
        'numero_pratica' => $faker->unique()->numberBetween(0, 50000),
        'numero_registrazione' => $faker->unique()->numberBetween(0, 100000),
        'stato_pratica' => $faker->numberBetween(0, 3), 
        'tipo_pratica' => $faker->numberBetween(0, 11), 
        'data_apertura' => $faker->dateTimeThisDecade(),
        
        'veicolo_parte' => $faker->randomElement($modelliAuto),
        'targa_parte' => strtoupper($faker->bothify('??###??')),
        'numero_polizza_parte' => strtoupper($faker->bothify('????######??##?#??')),
        
        'conducente_controparte' => $faker->name,
        'via_controparte' => $faker->streetAddress,
        'citta_controparte' => $faker->state,
        'telefono_controparte' => $faker->e164PhoneNumber,
        'veicolo_controparte' => $faker->randomElement($modelliAuto),
        'targa_controparte' => strtoupper($faker->bothify('??###??')),
        'numero_polizza_controparte' => strtoupper($faker->bothify('????######??##?#??')),
        'proprietario_mezzo_responsabile' => $faker->optional($weight = 0.2)->name,
        'medico_controparte' => $faker->optional($weight = 0.8)->name,
        'luogo_medico_controparte' => $faker->streetAddress,
        'data_medico_controparte' => strtoupper($faker->bothify('##/##/## ORE ##:##')),
        'liquidatore' => $faker->name,
        'reperibilita_liquidatore' => "Sempre reperibile",
        'parcella_presunta' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 10000),
        
        'legale' => $faker->optional($weight = 0.8)->name,
        'in_data' => $faker->dateTimeThisDecade(),
        'controllato' => $faker->numberBetween(0, 1),
        'data_ultima_lettera' => $faker->optional($weight = 0.8)->dateTimeThisDecade(),
        'mezzo_liquidato' => $faker->dateTimeThisDecade(), 
        'valore_mezzo_liquidato' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 10000),
        'rilievi' => $faker->numberBetween(0, 3),
        'data_chiusura' => $faker->optional($weight = 0.8)->dateTimeThisDecade(),
        'importo_sospeso' => $faker->optional($weight = 0.8)->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 3000),
        'data_sospeso' => $faker->optional($weight = 0.8)->dateTimeThisDecade(),
        'onorari_omnia' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 10000),
        'liquidato_omnia' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 10000),
        'stato_avanzamento' => $faker->text,
        
        'data_sinistro' => $faker->dateTimeThisDecade(),
        'ora_sinistro' => $faker->time,
        'luogo_sinistro' => $faker->city,
        'comando_autorita' => $faker->optional($weight = 0.8)->state,
        'testimoni' => $faker->optional($weight = 0.8)->name,
        'rivalsa' => $faker->numberBetween(0, 4), 
        'soccorso' => $faker->numberBetween(0, 4), 
        'tipologia_intervento' => $faker->randomElement($tipologieIntervento),
        'danno_presunto' => $faker->optional(0.8)->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 70000),
        'numero_sinistro' => strtoupper($faker->bothify('????##/####??##/?#??')),
        
        'assicurazione_risarcente' => $faker->company,
        'assicurazione_responsabile' => $faker->company,
        'mezzo_visibile' => $faker->optional($weight = 0.8)->randomElement(['Carrozzeria Tre Ponti', 'Carrozzeria Interdonato',
                                                                            'Previa telefonata al nostro assistito', 'Demolito']),
        'dinamica_sinistro' => $faker->optional($weight = 0.8)->randomElement($dinamiche),                                                                                                                                                              
        'scheda_pratica' => $faker->optional()->text,
        
        'cliente_id' => $cliente->id,
        'assicurazione_parte_id' =>  App\CompagniaAssicurativa::where('filiale_id', $cliente->filiale->id)->get()->random()->id,
        'assicurazione_controparte_id' => App\CompagniaAssicurativa::where('filiale_id', $cliente->filiale->id)->get()->random()->id,
        'autorita_id' => \App\Autorita::all()->random()->id,
    ];
});


$factory->define(App\Assegno::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
    $faker->addProvider(new Faker\Provider\it_IT\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Company($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Internet($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Payment($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Text($faker));
    
    return [
        'data' => $faker->dateTimeThisDecade(),
        'importo' => $faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 3000),
        'banca' => $faker->company,
        'data_azione' => $faker->dateTimeThisDecade(),
        'tipologia' => $faker->numberBetween(0, 1),
        
        'pratica_id' => App\Pratica::all()->random()->id
    ];
});


$factory->define(App\CompagniaAssicurativa::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
    $faker->addProvider(new Faker\Provider\it_IT\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Company($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Internet($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Payment($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Text($faker));
    
    return [
        'nome' => $faker->company,
        'indirizzo' => $faker->address,
        'telefono' => $faker->e164PhoneNumber,
        'fax' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,

        'filiale_id' => \App\Filiale::all()->random()->id,
    ];
});


$factory->define(App\PrestazioneMedica::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Address($faker));
    $faker->addProvider(new Faker\Provider\it_IT\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Company($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Internet($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Payment($faker));
    $faker->addProvider(new Faker\Provider\it_IT\Text($faker));
    
    $conv = $faker->boolean;
    
    return [
        'nome_medico' => $faker->randomElement(['Dott. Bruno Rossi', 'Dott. Franco Pinna', 'Dott.sa Sara Mirto', 'Dott.sa Alessia Manca']),
        'data' => $faker->dateTimeThisDecade(),
        'percentuale' => $conv ? $faker->randomElement([5, 10, 15, 20, 25]) : 0,
        'giorni' => $faker->numberBetween(3, 40),
        'costo' => $faker->numberBetween(0, 300) * 10,
        
        'pratica_id' => \App\Pratica::all()->random()->id,
    ];
    

    
    $table->integer('pratica_id')->unsigned();

    return [
        'nome' => $faker->company,
        'indirizzo' => $faker->address,
        'telefono' => $faker->e164PhoneNumber,
        'fax' => $faker->tollFreePhoneNumber,
        'email' => $faker->email,

        'filiale_id' => \App\Filiale::all()->random()->id,
    ];
});