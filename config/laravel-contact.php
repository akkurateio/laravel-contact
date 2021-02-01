<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    */
    'routes' => [
        'api' => [
            'enabled' => true,
            'middleware' => ['api', 'auth:api', 'akk-api', 'permission:contact'],
            'prefix' => 'api/v1/accounts/{uuid}/packages/contact',
            'as' => 'api.contact.'
        ]
    ],

    /*
    * Permissions
    */
    'permissions' => [
        ['name' => 'contact', 'label' => 'Accéder au module Contact'],
    ],

    /*
    * Roles
    */
    'roles' => [
        //
    ],

    /*
    * Roles’ permissions
    */
    'roles_permissions' => [
        //
    ],

    'address' => [
        'display' => [
            'delimiter' => ' • '
        ]
    ],

    'seeds' => [
        'types' => [
            [
                'code' => 'WORK',
                'name' => 'Professionnel',
                'shortname' => 'Pro',
                'description' => 'Moyen de contact professionnel',
                'priority' => 1,
                'is_active' => 1,
            ],
            [
                'code' => 'HOME',
                'name' => 'Personnel',
                'shortname' => 'Perso',
                'description' => 'Moyen de contact personnel',
                'priority' => 2,
                'is_active' => 1,
            ],
            [
                'code' => 'BILLING',
                'name' => 'Facturation',
                'shortname' => 'Fact',
                'description' => 'Adresse de facturation',
                'priority' => 3,
                'is_active' => 1,
            ],
            [
                'code' => 'DELIVERY',
                'name' => 'Livraison',
                'shortname' => 'Liv',
                'description' => 'Adresse de livraison',
                'priority' => 4,
                'is_active' => 1,
            ],
            [
                'code' => 'MOBILE',
                'name' => 'Portable',
                'shortname' => 'Cell',
                'description' => 'Téléphone portable',
                'priority' => 5,
                'is_active' => 1,
            ],
    ]
    ]

];
