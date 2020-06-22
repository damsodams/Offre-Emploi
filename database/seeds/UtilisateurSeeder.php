<?php

use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name'=> 'admin',
        'email'=> 'admin@gmail.com',
        'password'=> bcrypt('admin'),
        'statut'=> 'Administrateur',
      ]);

      DB::table('users')->insert([
        'name'=> 'Arthur',
        'email'=> 'arthur.labs21@outlook.fr',
        'password'=> bcrypt('arthur'),
        'statut'=> 'Utilisateur',
      ]);

      DB::table('users')->insert([
        'name'=> 'Hugo',
        'email'=> 'hugobuffard@live.fr',
        'password'=> bcrypt('hugo'),
        'statut'=> 'Utilisateur',
      ]);

      DB::table('users')->insert([
        'name'=> 'Damien',
        'email'=> 'damien.payet@gmail.com',
        'password'=> bcrypt('damien'),
        'statut'=> 'Entreprise',
        'entreprise_id'=> 1,
      ]);

      DB::table('users')->insert([
        'name'=> 'Florent',
        'email'=> 'florent.p@gmail.com',
        'password'=> bcrypt('florent'),
        'statut'=> 'Entreprise',
        'entreprise_id'=> 2,
      ]);
    }
}
