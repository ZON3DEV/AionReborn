<?php $form = Yii::app()->controller->beginWidget('CActiveForm'); ?>
<div class="login-form">
	<div class="label-login"><?php echo $form->label($model,'username')?></div>
	<div class="field-login"><?php echo $form->textField($model,'username', array('class'=>'text')); ?></div>
	<div><?php echo $form->error($model,'username', array('class' => 'errorPopup')); ?></div>
	<div class="clear"></div>
	<div class="label-password"><?php echo $form->label($model,'password')?></div>
	<div class="field-password"><?php echo $form->passwordField($model,'password',  array('class'=>'text')); ?></div>
	<div><?php echo $form->error($model,'password', array('class' => 'errorPopup')); ?></div>
	<div class="clear"></div>
	<?php echo CHtml::submitButton('Enter', array('class'=>'button')); ?>
	<div class="remember"><?php echo $form->checkBox($model,'rememberMe'); ?><?php echo $form->label($model,'rememberMe'); ?></div>
	<div class="clear"></div>
</div>
<?php Yii::app()->controller->endWidget(); ?>