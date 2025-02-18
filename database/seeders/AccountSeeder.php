<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $accountTypes = AccountType::all();

        // Create some sample accounts
        $accounts = [
            [
                'name' => 'Cotisations',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => 'Primary savings account',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
            [
                'name' => 'Développement',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => 'Caisse Développement',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
            [
                'name' => 'Secours',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => 'Caisse Secours',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
            [
                'name' => 'Epargnes',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => 'Caisse Epargnes',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
            [
                'name' => 'Crédit Scolaire',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => ' operations account',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
            [
                'name' => 'Ration',
                'balance' => 0,
                'currency' => 'XAF',
                'description' => ' operations account',
                'account_type_id' => $accountTypes->where('name', 'Savings ')->first()->id,
            ],
        ];

        foreach ($accounts as $accountData) {
            $accountData['user_id'] = $user->id;
            Account::create($accountData);
        }
    }
}
