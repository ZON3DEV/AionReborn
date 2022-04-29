<?php $this->setPageTitle('Login'); ?>


<div class="note">
	<div class="note-title">User Authorization</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($model,'username')?></div>
				<div class="w200"><?php echo $form->textField($model,'username', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($model,'username', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($model,'password'); ?></div>
				<div class="w200"><?php echo $form->passwordField($model,'password', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($model,'password', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($model,'captcha', array('class'=>'text')) ?></div>
				<div><?php echo $form->error($model,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row rememberMe">
				<div><?php echo $form->label($model,'rememberMe'); ?></div>
				<div class="w200"><?php echo $form->checkBox($model,'rememberMe'); ?></div>
				<div><?php echo $form->error($model,'rememberMe', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<div><?php echo CHtml::submitButton('Submit', array('class'=>'button')); ?></div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>