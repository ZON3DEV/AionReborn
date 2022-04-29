<?php $this->setPageTitle('Resend email to activate account'); ?>

<div class="note">
	<div class="note-title">Resend email to activate account</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo @Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post, 'login'); ?></div>
				<div class="w200"><?php echo $form->textField($post, 'login', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'login', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<div class="w200"><?php echo CHtml::submitButton('Submit', array('class'=>'button')); ?></div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>