<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Sentinel as Sentinel;

class DataUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('roles')->truncate();
        DB::table('throttle')->truncate();
        $rows = [
            [
                'name' => 'Administrador',
                'slug' => 'administrator',
                'permissions' => [
                    'read' => true,
                    'create' => true,
                    'update' => true,
                    'delete' => true,
                ]
            ],
            [
                'name' => 'Client',
                'slug' => 'client',
                'permissions' => [
                    'read' => true,
                    'create' => false,
                    'update' => false,
                    'delete' => false,
                ]
            ]
        ];
        foreach( $rows as $row ) :
			$role = Sentinel::getRoleRepository()->createModel()->create( $row );
        endforeach;
		DB::table('users')->truncate();
		DB::table('role_users')->truncate();
		DB::table('activations')->truncate();
		DB::table('reminders')->truncate();
		DB::table('persistences')->truncate();
		$rows = [
			[
				'email' => 'admin@library.com',
				'password' => '123admin',
				'first_name' => 'Admin',
				'last_name' => 'Library',
				'role' => [ 1 ],
			],
			[
				'email' => 'santiago@email.com',
				'password' => '123san',
				'first_name' => 'Santiago',
				'last_name' => 'Mora',
				'role' => [ 2 ],
			],
			[
				'email' => 'carlos@email.com',
				'password' => '123car',
				'first_name' => 'Carlos',
				'last_name' => 'Gea',
				'role' => [ 2 ],
			],
		];

		foreach( $rows as $row ) :
			$role = $row['role'][0];
			unset( $row['role'] );
			$user = Sentinel::registerAndActivate( $row );
			$role = Sentinel::findRoleById( $role );
			$user->roles()->attach( $role );
		endforeach;
    }
}
