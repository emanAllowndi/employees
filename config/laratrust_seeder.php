<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'administrations' => 'c,r,u,d',
            'behaviors' => 'c,r,u,d',
            'holiday_palances' => 'c,r,u,d',
            'jobs' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'sectors' => 'c,r,u,d',
            'trainings' => 'c,r,u,d',
            'holidaies' => 'c,r,u,d',
            'official_holidaies' => 'c,r,u,d',
            'tasks' => 'c,r,u,d',
            'pers' => 'c,r,u,d',
            'emps' => 'c,r,u,d',
            'attendances' => 'c,r,u,d',
            'holidaytypes' => 'c,r,u,d',


        ],

        'admin' => [],


    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
