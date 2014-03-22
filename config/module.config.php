<?php
return [
    'service_manager' => [
        'invokables' => [
            'OjColorboxModule\View\Strategy\ColorboxStrategy' => 'OjColorboxModule\View\Strategy\ColorboxStrategy',
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'OjColorboxModule' => __DIR__ . '/../view/'
        ]
    ],
];
