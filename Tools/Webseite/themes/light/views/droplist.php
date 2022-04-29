<?php $this->setPageTitle('Server droplist'); ?>

<div class="note">
	<div class="note-title">Search droplist by server</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo @Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'mob_id'); ?></div>
				<div class="w200"><?php echo $form->textField($post,'mob_id', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'mob_id', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php echo $form->label($post,'item_id'); ?></div>
				<div class="w200"><?php echo $form->textField($post,'item_id', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'item_id', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($post,'captcha', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<div class="w200"><?php echo CHtml::submitButton('Search', array('class'=>'button')); ?></div>
				<div></div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php if ($model): ?>
<div class="note">
	<div class="note-title">List Item</div>
	<div class="note-body">
		<table class="table">
			<tr>
				<th>Title</th>
				<th>Npc ID</th>
				<th>Min.</th>
				<th>Max.</th>
				<th>Chance</th>
			</tr>
			<?php foreach ($model as $data) : ?>
			<tr class="center">
				<td><?php echo Adb::url('item', $data['item_id'], 3); ?></td>
				<td><?php echo Adb::url('npc', $data['mob_id'], 1); ?></td>
				<td><?php echo $data['min']; ?></td>
				<td><?php echo $data['max']; ?></td>
				<td><?php echo $data['chance']; ?></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
<?php endif; ?>