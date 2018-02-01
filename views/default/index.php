<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use mergit\shorty\ShortyAsset;

$this->title = 'Home';
$boundle = ShortyAsset::register($this);
$js = <<<JS
 $('form').on('beforeSubmit', function(){     
     var data = $('form input[type=\'text\'] , form input[type=\'hidden\']').serialize();
     $.ajax({
        url: 'index.php',
        type: 'POST',
        dataType : 'json',
        data: data,
        success: function(res) {
            console.log(res);
            $('#shortlink-id').val(res[1]);
            
            
            if (res[2] == 0) {
                var message = '<div class="alert alert-info">' + res[3] + '</div>';
            } else if (res[2] == 1) {
                var message = '<div class="alert alert-success"><strong>Готово! </strong>' + res[3] + '</div>';
            } else {
                var message = '<div class="alert alert-danger"><strong>Ошибка! </strong>' + res[3] + '</div>';
            }
            
            var html = "<div class='well'><h4><div id='shortlnk' class='col-sm-6 text-left'>Ваш короткий линк <span class='label label-primary'>" + res[0][0] + "</span></div><div class='col-sm-6 text-right'>Линк для статистики <span class='label label-primary'>" + res[0][1] + "</span></div></h4><hr>";    
            html    += "<h4>" + message + "</h4><hr>";
            html    += "<div class='row'><div class='input-group text-right'><label class='btn btn-default disabled' style='width:50%; text-align:right'>";
            html    += res[0][2] + "</label><input type='text' class='form-control' style='float:right; width:50%' name='Shortlink[custom_url]' value='" + res[0][3] + "'>";            
            html    += "<div class='input-group-btn'><button class='btn btn-basic' type='submit'>Получить собственный линк";
            html    += "</button></div></div>";
            html    += "<pre class='text-info'>Ваш собственный URL должен начинаться с буквы и содержать только латинские буквы, числа и символ подчеркивания</pre>";
            html    += "</div>";
            
            $( "div.output" ).html( html );
        },
        error: function() {
            alert('error!');
        }
     });
     
 return false;
 });
JS;

$this->registerJs($js);
?>









<div class="container">
    <div class="row">

    </div>
</div>
<div class="<?= $this->context->action->uniqueId ?>">
<?php $form = ActiveForm::begin([
    'layout'=>'horizontal',
    'options' => ['class' => 'input-group'],
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        'horizontalCssClasses' => [
            'label' => '',
            'offset' => '',
            'wrapper' => 'col-sm-12',
            'error' => '',
            'hint' => '',
        ],
    ],
]);
?>
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <?= $form->field($model, 'url')->textInput(['placeholder' => $model->getAttributeLabel('url')], ['maxlength' => true]);?>


                <?= $form->field($model, 'id')->hiddenInput(['value' => ''])?>
                <input type="hidden" id="model_id" value="">

            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'available_at')->widget(\yii\jui\DatePicker::ClassName(), [
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['placeholder' => $model->getAttributeLabel('available_at')],
                ]) ?>
            </div>
            <div class="col-sm-3 text-right">
                <?= Html::submitButton('Уменьшить', ['id' => 'mainSubmit', 'class' => 'btn btn-primary', 'name' => 'create-link-button']);?>
            </div>

        </div>

            <div class="output">
            </div>

    </div>



<?php ActiveForm::end(); ?>
</div>
