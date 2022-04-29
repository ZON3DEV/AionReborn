<?php $this->setPageTitle('Kontoverwaltung'); ?>

<div class="note">
	<div class="note-title">Mein Konto</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data'))); echo @Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'email')?></div>
				<div class="w200"><?php echo $form->textField($post,'email', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'email', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'image')?></div>
				<div class="w200"><?php echo $form->fileField($post,'image', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'image', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password_new'); ?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_new', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_new', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password_repeat'); ?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_repeat', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_repeat', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'password_current'); ?></div>
				<div class="w200"><?php echo $form->passwordField($post,'password_current', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'password_current', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<?php echo CHtml::submitButton('Apply', array('class'=>'button')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>