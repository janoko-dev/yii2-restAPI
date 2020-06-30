# yii2-restAPI
Package for implement restAPI in yii2 framework

## Change controller

```php
class AuthController extends janokoDev\restAPI\API
{
  // ....
}
```

## Behaviour

```php

class AuthController extends janokoDev\restAPI\API
{
    public function behaviors()
    {
        $behv = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post']
                ],
            ],
            'authenticator' => [
                'except' => ['login']
            ]
        ];

        $behv = array_merge_recursive(parent::behaviors(), $behv);
        return $behv;
    }
    
    //.....
}
```

## Config for json parsing

change app/config/main.php. Add JSON parser in componen -> request. 

```php
return [

    // .....
    
    'components' => [
        'request' => [
        
            // .....
            
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
    ],
    
    // .....
];
```
