<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user-group', 'User Groups');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
               <li class="active">
                   <?= Html::a(Yii::t('common', 'Index'), 'javascript:;') ?>
               </li>
               <li data-original-title="<?= Yii::t('common', 'Click').'('.Yii::t('common', 'Create').')'?>" data-toggle="tooltip">
                    <?= Html::a(Yii::t('common', 'Create'), ['create']) ?>
               </li>
            </ul>
           
            <div class="tab-content clearfix">
                <div class="tab-pane active user-group-index">
                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        
                        'dataColumnClass' => 'yii\grid\DataColumn',//默认数据列以yii\grid\DataColumn来显示
                        //'caption' => '标题',//表格的头部， 即caption标题
                        //'captionOptions' => [],//表格的头部样式
                        'options' => ['class' => 'grid-view box-body table-responsive no-padding'],//整个grid view样式//\yii\helpers\Html::renderTagAttributes()
                        'tableOptions' => ['class'=>'table table-hover table-striped table-bordered'],//表格总样式
                        
                        'headerRowOptions' => [],//头部单行样式//\yii\helpers\Html::renderTagAttributes()
                        'footerRowOptions' => [],//底部单行样式//\yii\helpers\Html::renderTagAttributes()
                        
                        'showHeader' => true,
                        'showFooter' => false,
                        
                        'layout' => "{summary}\n{errors}\n{items}\n{pager}",//布局
                        
                        /**
                         * @var array|Closure the HTML attributes for the table body rows. This can be either an array
                         * specifying the common HTML attributes for all body rows, or an anonymous function that
                         * returns an array of the HTML attributes. The anonymous function will be called once for every
                         * data model returned by [[dataProvider]]. It should have the following signature:
                         *
                         * ```php
                         * function ($model, $key, $index, $grid)
                         * ```
                         *
                         * - `$model`: the current data model being rendered
                         * - `$key`: the key value associated with the current data model
                         * - `$index`: the zero-based index of the data model in the model array returned by [[dataProvider]]
                         * - `$grid`: the GridView object
                         *
                         * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
                         */
                        //public $rowOptions = [];
                        /**
                         * @var Closure an anonymous function that is called once BEFORE rendering each data model.
                         * It should have the similar signature as [[rowOptions]]. The return result of the function
                         * will be rendered directly.
                         */
                        //public $beforeRow;
                        /**
                         * @var Closure an anonymous function that is called once AFTER rendering each data model.
                         * It should have the similar signature as [[rowOptions]]. The return result of the function
                         * will be rendered directly.
                         */
                        //public $afterRow;
                        
                        /**
                         * @var boolean whether to show the grid view if [[dataProvider]] returns no data.
                         */
                        //public $showOnEmpty = true;
                        /**
                         * @var array|Formatter the formatter used to format model attribute values into displayable texts.
                         * This can be either an instance of [[Formatter]] or an configuration array for creating the [[Formatter]]
                         * instance. If this property is not set, the "formatter" application component will be used.
                         */
                        //public $formatter;
                        /**
                         * @var array grid column configuration. Each array element represents the configuration
                         * for one particular grid column. For example,
                         *
                         * ```php
                         * [
                         *     ['class' => SerialColumn::className()],
                         *     [
                         *         'class' => DataColumn::className(), // this line is optional
                         *         'attribute' => 'name',
                         *         'format' => 'text',
                         *         'label' => 'Name',
                         *     ],
                         *     ['class' => CheckboxColumn::className()],
                         * ]
                         * ```
                         *
                         * If a column is of class [[DataColumn]], the "class" element can be omitted.
                         *
                         * As a shortcut format, a string may be used to specify the configuration of a data column
                         * which only contains [[DataColumn::attribute|attribute]], [[DataColumn::format|format]],
                         * and/or [[DataColumn::label|label]] options: `"attribute:format:label"`.
                         * For example, the above "name" column can also be specified as: `"name:text:Name"`.
                         * Both "format" and "label" are optional. They will take default values if absent.
                         *
                         * Using the shortcut format the configuration for columns in simple cases would look like this:
                         *
                         * ```php
                         * [
                         *     'id',
                         *     'amount:currency:Total Amount',
                         *     'created_at:datetime',
                         * ]
                         * ```
                         *
                         * When using a [[dataProvider]] with active records, you can also display values from related records,
                         * e.g. the `name` attribute of the `author` relation:
                         *
                         * ```php
                         * // shortcut syntax
                         * 'author.name',
                         * // full syntax
                         * [
                         *     'attribute' => 'author.name',
                         *     // ...
                         * ]
                         * ```
                         */
                        //public $columns = [];
                        /**
                         * @var string the HTML display when the content of a cell is empty
                         */
                        //public $emptyCell = '&nbsp;';
                        /**
                         * @var \yii\base\Model the model that keeps the user-entered filter data. When this property is set,
                         * the grid view will enable column-based filtering. Each data column by default will display a text field
                         * at the top that users can fill in to filter the data.
                         *
                         * Note that in order to show an input field for filtering, a column must have its [[DataColumn::attribute]]
                         * property set or have [[DataColumn::filter]] set as the HTML code for the input field.
                         *
                         * When this property is not set (null) the filtering feature is disabled.
                         */
                        //public $filterModel;
                        /**
                         * @var string|array the URL for returning the filtering result. [[Url::to()]] will be called to
                         * normalize the URL. If not set, the current controller action will be used.
                         * When the user makes change to any filter input, the current filtering inputs will be appended
                         * as GET parameters to this URL.
                         */
                        //public $filterUrl;
                        /**
                         * @var string additional jQuery selector for selecting filter input fields
                         */
                        //public $filterSelector;
                        /**
                         * @var string whether the filters should be displayed in the grid view. Valid values include:
                         *
                         * - [[FILTER_POS_HEADER]]: the filters will be displayed on top of each column's header cell.
                         * - [[FILTER_POS_BODY]]: the filters will be displayed right below each column's header cell.
                         * - [[FILTER_POS_FOOTER]]: the filters will be displayed below each column's footer cell.
                         */
                        //public $filterPosition = self::FILTER_POS_BODY;
                        /**
                         * @var array the HTML attributes for the filter row element.
                         * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
                         */
                        //public $filterRowOptions = ['class' => 'filters'];
                        /**
                         * @var array the options for rendering the filter error summary.
                         * Please refer to [[Html::errorSummary()]] for more details about how to specify the options.
                         * @see renderErrors()
                         */
                        //public $filterErrorSummaryOptions = ['class' => 'error-summary'];
                        /**
                         * @var array the options for rendering every filter error message.
                         * This is mainly used by [[Html::error()]] when rendering an error message next to every filter input field.
                         */
                        //public $filterErrorOptions = ['class' => 'help-block'];
                        
                        
                        
                        'columns' => [
                            ['class' => 'yii\grid\CheckboxColumn'],
                            //['class' => 'yii\grid\SerialColumn'],
                
                            //以下默认DataColumn
                            [
                                'class' => 'yii\grid\DataColumn',
                                'attribute' => 'name',
                            ],
                            'description:ntext',
                            [
                                'attribute' => 'status',
                                'value' => function($model){
                                    return $model->status == 1 ? Yii::t('common', 'On') : Yii::t('common', 'Off');
                                },
                            ],
                            'sort',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => Yii::t('common', 'Opration'),
                            ],
                        ],
                    ]); ?>
                </div>
                
            </div>
        </div>
	        
    </div>
</div>



