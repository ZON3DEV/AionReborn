<?php $this->setPageTitle('Изменение пароля'); ?>

<div class="note">
	<div class="note-title">Изменение пароля</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'password_new')?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_new', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_new', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password_repeat')?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_repeat', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_repeat', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($post,'captcha', array('class'=>'text')) ?></div>
				<div><?php echo $form->error($post,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<?php echo CHtml::submitButton('Сохранить', array('class'=>'button')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>