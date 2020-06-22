<?php

use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Entreprise 1
        DB::table('entreprises')->insert([
          'nom'=> 'Stormshield',
          'ville'=> 'Lyon 9e',
          'codePostal'=> '69009',
          'adresse'=> '1 Place Giovanni da Verrazzano',
          'mail' => 'stormshield@gmail.com',
          'contact' => 'Mr X',
          'telephone' => '06.31.59.45.12',
        ]);

        //Entreprise 2
        DB::table('entreprises')->insert([
          'nom'=> 'AGCO',
          'ville'=> 'Dijon',
          'codePostal'=> '21000',
          'adresse'=> '30 Boulevard de Brosses',
          'mail' => 'agco@gmail.com',
          'contact' => 'Mr X',
          'telephone' => '06.33.15.69.12',
        ]);

        //Entreprise 3
        DB::table('entreprises')->insert([
          'nom'=> 'Sidec',
          'ville'=> 'Lons_le_saunier',
          'codePostal'=> '39000',
          'adresse'=> '1 Rue Maurice Chevassu',
          'mail' => 'contact-sidec@gmail.com',
          'contact' => 'Mr Pelletier',
          'telephone' => '06.33.15.69.12',
          'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2738.056093274369!2d5.538787015803469!3d46.665153660526336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478cd797d046aea9%3A0x46376bf85ca43d1b!2s1%20Rue%20Maurice%20Chevassu%2C%2039000%20Lons-le-Saunier!5e0!3m2!1sfr!2sfr!4v1588509226751!5m2!1sfr!2sfr'
        ]);
    }
}
