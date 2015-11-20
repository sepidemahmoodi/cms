<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kalpok\helpers\Utility;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use kalpok\i18n\widgets\LanguageSelect;
use modules\post\backend\models\Category;
use themes\admin360\widgets\editor\Editor;
use dosamigos\selectize\SelectizeTextInput;
use kalpok\file\widgets\singleupload\SingleImageUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="post-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات نوشته'
            ]) ?>
                <?=
                    $form->field($model, 'title')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-large'
                            ]
                        )
                ?>

                <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

                <?=
                    $form->field($model, 'content')
                        ->widget(
                            Editor::className(),
                            ['preset' => 'advanced']
                        )
                ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            <?php Panel::end() ?>

            <?php if (Yii::$app->i18n->isMultiLanguage()): ?>
                <?php Panel::begin([
                    'title' => 'زبان'
                ]) ?>
                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'language')->widget(
                            LanguageSelect::className(),
                            ['options' => ['class' => 'form-control input-large']]
                        )->label(false); ?>
                    <?php else: ?>
                        <?= $form->field($model, 'language')->textInput([
                            'class' => 'form-control input-large',
                            'disabled' => true,
                            'value' => Yii::$app->formatter->asLanguage($model->language)
                        ])->label(false) ?>
                    <?php endif ?>
                <?php Panel::end() ?>
            <?php endif ?>

            <?php Panel::begin([
                'title' => 'تصویر شاخص'
            ]) ?>
                <?php
                    echo SingleImageUpload::widget(
                        [
                            'model' => $model,
                            'group' => 'image',
                        ]
                    );
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'دسته‌ها'
            ]) ?>
                <?= $form->field($model, 'categories')->widget(
                        SelectizeTextInput::className(),
                        [
                            'options' => ['class' => 'form-control'],
                            'clientOptions' => [
                                'create' => false,
                                'options' => Utility::makeReadyForSelectize(
                                    Category::find()->all(),
                                    'title',
                                    'title'
                                ),
                                'items' => $model->getCategoriesAsArray(),
                                'valueField' => 'title',
                                'labelField' => 'title',
                                'searchField' => ['title'],
                                'plugins' => ['remove_button'],
                            ],
                        ]
                    )->label('');
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'ویژگی های نوشته'
            ]) ?>
                <?= $form->field($model, 'isActive')->checkbox(); ?>
                    
                <?= $form->field($model, 'priority')
                    ->dropDownList(
                        Utility::listNumbers(10, 1),
                        ['prompt' => '', 'class' => 'form-control input-medium']
                    )
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>




