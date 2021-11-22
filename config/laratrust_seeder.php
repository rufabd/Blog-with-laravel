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
        'admin' => [
            'users' => 'c,r,u,d',
            'blog_posts' => 'r,d',
            'categories' => 'r,d',
            'comments' => 'r,d',
            'contacts' => 'r,d',
            'feedback' => 'r,d',
            'problems' => 'r,d'
        ],
        'blogWriter' => [
            'users' => 'c',
            'blog_posts' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
        ],
        'user' => [
            'users' => 'c,r,u,d',
            'blog_posts' => 'r',
            'categories' => 'r',
            'comments' => 'c,r,u',
            'contacts' => 'c',
            'feedback' => 'c,r,u',
            'problems' => 'c'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
