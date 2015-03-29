jQuery RangeFilter Extension for Yii 2
=======================================

This is the jQuery RangeFilter extension for Yii 2. It encapsulates RangeFilter component in terms of Yii widgets,
and thus makes using RangeFilter component in Yii applications extremely easy


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist diogobd/yii2-rangefilter "*"
```

or add

```
"diogobd/yii2-rangefilter": "*"
```

to the require section of your `composer.json` file.

How to use
----------

```php
echo RangeFilter::widget([
    'model' => $model,
    'attribute' => 'attachment_1',
    'options' => [
        'year' => true,
        'month' => true,
        'day' => false
    ]
]);
```


