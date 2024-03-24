<?php

return [

    'owner' => [

        'api.v1.medications.index',

        'api.v1.medications.store',

        'api.v1.medications.show',

        'api.v1.medications.update',

        'api.v1.medications.delete',

        'api.v1.medications.force-delete',

        'api.v1.customers.index',

        'api.v1.customers.store',

        'api.v1.customers.show',

        'api.v1.customers.update',

        'api.v1.customers.delete',

        'api.v1.customers.force-delete'

    ],

    'manager' => [

        'api.v1.medications.index',

        'api.v1.medications.show',

        'api.v1.medications.update',

        'api.v1.medications.delete',

        'api.v1.customers.index',

        'api.v1.customers.show',

        'api.v1.customers.update',

        'api.v1.customers.delete'

    ],

    'cashier' => [

        'api.v1.medications.index',

        'api.v1.medications.show',

        'api.v1.medications.update',

        'api.v1.customers.index',

        'api.v1.customers.show',

        'api.v1.customers.update'

    ]

];
