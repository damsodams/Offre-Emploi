<?php

use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //OFFRE 1 -> Stormshield
      DB::table('offres')->insert([
        'titre'=> 'Cherche developpeur web Java script',
        'description'=> 'blablablablablabla',
        'intitule_poste'=>'Développeur Web JavaScript',
        'niveau'=> 'BTS',
        'pdf'=> '',
        'salaire'=>'42000/an',
        'secteur'=>'Développement',
        'type_contrat' => 'CDI',
        'entreprise_id'=> 1,
      ]);

      //OFFRE 2 -> AGCO
      DB::table('offres')->insert([
        'titre'=> 'Cherche un ingénieur informatique',
        'description'=> 'blibliblibliblibli',
        'pdf'=> '',
        'intitule_poste'=>'Administrateur systeme',
        'niveau'=> 'Licence',
        'salaire'=>'55000/an',
        'secteur'=>'Infrastructure',
        'type_contrat' => 'CDI',
        'entreprise_id'=> 2,
      ]);

      //OFFRE 3 -> Stormshield
      DB::table('offres')->insert([
        'titre'=> 'Cherche un developpeur C++',
        'description'=> 'blibliblibliblibli',
        'pdf'=> '',
        'intitule_poste'=>'Developpeur',
        'niveau'=> 'BAC',
        'salaire'=>'25000/an',
        'secteur'=>'Developpement',
        'type_contrat' => 'CDI',
        'entreprise_id'=> 1,
      ]);

      //OFFRE 3 -> Sidec
      DB::table('offres')->insert([
        'titre'=> 'Cherche un admin sys',
        'description'=> 'blibliblibliblibli',
        'intitule_poste'=>'Developpeur',
        'niveau'=> 'BAC',
        'pdf'=> '',
        'salaire'=>'25000/an',
        'secteur'=>'Developpement',
        'type_contrat' => 'CDI',
        'entreprise_id'=> 3,

      ]);
    }
}
