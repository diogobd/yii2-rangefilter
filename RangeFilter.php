<?php

namespace app\components\widgets;


use diogobd\rangefilter\RangeFilterAsset;
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
class QueryBuilder extends InputWidget
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
        $hiddenId = ArrayHelper::remove($this->options, 'id');

        /*if ($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
            echo Html::activeHiddenInput($this->model, $this->attribute, ['id' => $hiddenId]);
        } else {
            $value = $value = $this->value;
            echo Html::hiddenInput($this->name, $value, ['id' => $hiddenId]);
        }*/

        echo Html::hiddenInput($this->name, null, ['id' => $hiddenId]);

        $id = $this->getId() . '-range';
        $this->options['id'] = $id;
        $var = Inflector::variablize($id);
        //echo Html::tag('textarea', Html::encode($value), $this->options);

        $view = $this->getView();
        RangeFilterAsset::register($view);

        $options = Json::encode($this->pluginOptions);

        $view->registerJs("var {$var} = jQuery('#$id').rangeFilter({$options});");

        /*$view->registerJs("var {$var} = CodeMirror.fromTextArea(document.getElementById('$id'), $options);");
        $view->registerJs("{$var}.on('change', function(editor){jQuery('#$hiddenId').val(editor.getValue());});");*/
    }
}