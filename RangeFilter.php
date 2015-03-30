<?php

namespace diogobd\rangefilter;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Renders a RangeFilter
 * @author Diogo Biolo D'Agostini <diogobd@gmail.com>
 * @since 1.0.0
 */
class RangeFilter extends InputWidget
{
    /**
     * @var array configuration options
     * @see https://github.com/diogobd/jquery-rangefilter/blob/master/examples/index.html
     */
    public $pluginOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])){
            $this->options['id'] = $this->getId();
        }

        $this->pluginOptions = ArrayHelper::merge([
            'year' => [
                'visible' => true,
                //'start' => 2011
                //'finish' => 2020
            ],
            'month' => [
                'visible' => true,
                'selected' => '*'
            ],
            'day' => [
                'visible' => true,
                'selected' => '*'
            ]
        ],$this->pluginOptions);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $id = $this->getId();
        $hiddenId = $id.'-hidden';
        echo Html::hiddenInput($this->name, null, ['id' => $hiddenId]);
        echo Html::tag('div', null, ['id' => $id]);

        $var = Inflector::variablize($id);
        $view = $this->getView();
        RangeFilterAsset::register($view);
        $options = Json::encode($this->pluginOptions);
        $view->registerJs("var {$var} = jQuery('#$id');");
        $view->registerJs("var {$var}.rangeFilter({$options});");
        $view->registerJs("jQuery('#$hiddenId').val(JSON.stringify({$var}.rangeFilter('getFilter')));");
        $view->registerJs("{$var}.on('rangefilter.change', function(){ jQuery('#$hiddenId').val(JSON.stringify({$var}.rangeFilter('getFilter'))); });");
    }
}