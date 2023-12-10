<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder {
  /**
   * Run the database user seeds.
   *
   * @return void
   */
  public function run() {
    $users = [
      [
        'name' => 'Sales Agent',
        'email' => 'sales@coffee.shop'
      ],
      [
        'name' => 'Sales Agent Payal',
        'email' => 'payal.desai06@gmail.com'
      ]
    ];
    collect($users)->map(function ($user) {
      User::factory()->create($user);
    });
  }
}
