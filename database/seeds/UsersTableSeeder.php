<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = config('users');
        foreach ($users as $user) {
            $nuovo_utente = new User();
            $nuovo_utente->name = $user['nome'];
            $nuovo_utente->lastname = $user['cognome'];
            $nuovo_utente->birthday = $user['data-nascita'];
            $nuovo_utente->email = $user['email'];
            $nuovo_utente->password = bcrypt($user['password']);
            $nuovo_utente->save();

        }
    }
}
