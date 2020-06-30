# yii2-restAPI
Package for implement restAPI in yii2 framework

## Change controller

```php
class AuthController extends janokoDev\restAPI\API
{
  // ....
}
```

## behaviour

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
