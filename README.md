# yii2-sentry
Sentry client for yii framework.

## Installation

`composer require --prefer-dist "jerryhsia/yii2-sentry" "dev-master"`

## Usage

Configure it in the `config/web.php` file.

```php
'components' => [
    'errorHandler' => [
        'class' => 'jerryhsia\sentry\ErrorHandler',
    ],
    'sentry' => [
        'class' => 'jerryhsia\sentry\Sentry',
        'dsn' => 'your sentry dsn',
        'options' => [
            'exclude' => [
                'yii\web\NotFoundHttpException',
                'yii\web\UnauthorizedHttpException',
                'yii\web\BadRequestHttpException',
                'yii\web\GoneHttpException',
                'yii\web\ForbiddenHttpException',
                'yii\web\MethodNotAllowedHttpException'
            ]
        ]
    ]
]
```
