<?php $this->setPageTitle('Восстановление пароля'); ?>

<div class="note">
	<div class="note-title">Восстановление пароля</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'login')?></div>
				<div class="w200"><?php echo $form->textField($post,'login', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'login', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($post,'captcha', array('class'=>'text')) ?></div>
				<div><?php echo $form->error($post,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<?php echo CHtml::submitButton('Отправить', array('class'=>'button')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>