<?php $this->setPageTitle('User Registration'); ?>

<div class="note">
	<div class="note-title">User Registration</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo $form->errorSummary($post); echo @Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'login')?></div>
				<div class="w200"><?php echo $form->textField($post,'login', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'login', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password'); ?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password_repeat'); ?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_repeat', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_repeat', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'email'); ?></div>
				<div class="w200"><?php echo $form->textField($post,'email', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'email', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($post,'captcha', array('class'=>'text')) ?></div>
				<div><?php echo $form->error($post,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<?php echo CHtml::submitButton('Register', array('class'=>'button')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>