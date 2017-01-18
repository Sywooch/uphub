<?php

$params = require(__DIR__.'/params.php');

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=uphub2016',
            'username' => 'uphub2016',
            'password' => 'uphub2016',
            'charset' => 'utf8',
        ],
        'mailer' => [
   'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'viewPath' => '@common/mail',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'uphub.u@gmail.com',
            'password' => 'uphub2015',
            'port' => '587',
            'encryption' => 'tls',
        ],
    ],
        'authManager' => [
        'class' => 'yii\rbac\DbManager',
    ],
    ],
];
