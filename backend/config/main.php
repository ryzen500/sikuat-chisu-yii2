

    <?php
    $params = array_merge(
        require __DIR__ . '/../../common/config/params.php',
        require __DIR__ . '/../../common/config/params-local.php',
        require __DIR__ . '/params.php',
        require __DIR__ . '/params-local.php'
    );
     
    return [
        'id' => 'app-backend',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'backend\controllers',
        'bootstrap' => ['log'],
        'modules' => [],
        'components' => [
     
                'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=sikuat_tb',  // Specify the port here
                'username' => 'ryzen500',
                'password' => 'ryzen500',
                'charset' => 'utf8',
            ],
            'request' => [
                'csrfParam' => '_csrf-backend',
            ],
            'user' => [
                'identityClass' => 'common\models\User',
                'enableAutoLogin' => true,
                'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            ],
            'session' => [
                // this is the name of the session cookie used for login on the backend
                'name' => 'advanced-backend',
            ],
            'log' => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => \yii\log\FileTarget::class,
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    'permohonan' => 'permohonan/index',
                    'permohonans' => 'permohonans/index',
                    'terduga' => 'terduga/index',
                    'pasien' => 'pasien/index',
                    'sample' => 'sample/index',
                    'hasilab' => 'hasilab/index',
                    'kasus' => 'kasus/index',
     
                ],
            ],
            
        ],
        'params' => $params,
    ];