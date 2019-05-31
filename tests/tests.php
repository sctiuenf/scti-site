<?php
require_once __DIR__.'/../app/db/db_functions.php';
require_once __DIR__.'/../app/models/User.php';

describe('User register', function($ctx){
    before_all(function($ctx){

    });

    it('should register an user', function($ctx){
        $n1 = 10;
        $n2 = 20;

        $res = $n1+$n2;
        expect()->to->be(30);
    });
});
?>