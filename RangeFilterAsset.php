<?php

namespace diogobd\rangefilter;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the [jquery RangeFilter library](https://github.com/diogobd/jquery-rangefilter)
 *
 * @author Diogo Biolo D'Agostini <diogobd@gmail.com>
 */
class RangeFilterAsset extends AssetBundle {

    public $sourcePath = '@bower/jquery-rangefilter/src';

    public $js = [
        'range-filter.js',
    ];

    public $css = [
        'css/range-filter.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'leandrogehlen\querybuilder\BootstrapAsset',
    ];

} 