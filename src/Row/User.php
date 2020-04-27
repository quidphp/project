<?php
declare(strict_types=1);
namespace Project\Row;
use Quid\Lemur;

// user
// class for a row of the user table
class User extends Lemur\Row\User
{
    // config
    protected static array $config = [
        'emailModel'=>[
            'resetPassword'=>'resetPassword',
            'userWelcome'=>'userWelcome'],
        'permission'=>[
            '*'=>['appLogin'=>false]]
    ];
}
?>