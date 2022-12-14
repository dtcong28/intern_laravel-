<?php
return [
    'messages' => [
        'CREATE_SUCCESS' => 'Add successfully',
        'UPDATE_SUCCESS' => 'Update successfully',
        'DELETE_SUCCESS' => 'Delete successfully',

        'CREATE_FAIL' => 'Add failure',
        'EDIT_FAIL' => 'Edit failure',
        'UPDATE_FAIL' => 'Update failure',
        'DELETE_FAIL' => 'Delete failure',

        'NO_DATA' => 'Data does not exist',

        'LOGIN_FAIL' => '(*) Email or password is incorrect'
    ],

    'path' => [
        'PATH_UPLOAD_EMPLOYEE' => 'public/uploads/employees',
        'PATH_EMPLOYEE'=> 'storage/uploads/employees/'
    ],

    'gender' => [
        'MALE' => 1,
        'FEMALE' => 2,
    ],

    'position' => [
        'MANAGER' => 1,
        'TEAM LEADER' => 2,
        'BSE' => 3,
        'DEV' => 4,
        'TESTER' => 5
    ],

    'typeWork' => [
        'FULLTIME' => 1,
        'PARTIME' => 2,
        'PROBATIONARY STAFF' => 3,
        'INTERN' => 4,
    ],

    'status' => [
        'ON WORKING' => 1,
        'RETIRED' => 2,
    ],

    'pagination' => [
        'PER_PAGE' => 5,
    ],

    'action' => [
        'ACTIVE' => 0,
        'DELETED' => 1,
    ]
];
