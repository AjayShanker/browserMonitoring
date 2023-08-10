<?php return array(
    'root' => array(
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'reference' => NULL,
        'name' => '__root__',
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'reference' => NULL,
            'dev_requirement' => false,
        ),
        'matomo/device-detector' => array(
            'pretty_version' => '6.1.4',
            'version' => '6.1.4.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../matomo/device-detector',
            'aliases' => array(),
            'reference' => '74f6c4f6732b3ad6cdf25560746841d522969112',
            'dev_requirement' => false,
        ),
        'mustangostang/spyc' => array(
            'pretty_version' => '0.6.3',
            'version' => '0.6.3.0',
            'type' => 'library',
            'install_path' => __DIR__ . '/../mustangostang/spyc',
            'aliases' => array(),
            'reference' => '4627c838b16550b666d15aeae1e5289dd5b77da0',
            'dev_requirement' => false,
        ),
        'piwik/device-detector' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '6.1.4',
            ),
        ),
    ),
);
