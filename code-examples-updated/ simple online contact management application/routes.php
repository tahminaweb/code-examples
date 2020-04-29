<?php
return [
    'GET' => [
        '/' => ['controller'=>'Home', 'class'=>'controllers/Home.php', 'method'=> 'index'],
        '/contacts/(\d+)/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'show'],
        '/contacts/(\d+)/edit/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'edit'],
        '/contacts/(\d+)/delete/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'delete'],
        '/contacts/add/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'add'],
        '/import/' => ['controller'=>'Import', 'class'=>'controllers/Import.php', 'method'=> 'index'],
    ],
    'POST' => [
        '/contacts/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'index'],
        '/contacts/add/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'save'],
        '/contacts/(\d+)/' => ['controller'=>'Contact', 'class'=>'controllers/Contact.php', 'method'=> 'update'],
        '/import/csv/' => ['controller'=>'Import', 'class'=>'controllers/Import.php', 'method'=> 'upload'],
    ]
];