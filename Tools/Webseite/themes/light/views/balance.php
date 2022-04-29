<?php $this->setPageTitle('Balance management'); ?>


<script>
	$('document').ready(function(){
		var el = $('select#TransferPointsForm_type');
		var v = el.val();
		if (v === 'ACCOUNT') {
			$('div#transfer-type-user').hide();
			$('div#transfer-type-account').show();
		}
		else if (v === 'USER') {
			$('div#transfer-type-account').hide();
			$('div#transfer-type-user').show();
		}
		el.change(function(){
			v = $(this).val();
			if (v === 'ACCOUNT') {
				$('input#TransferPointsForm_recipient_user').val('');
				$('div#transfer-type-user').hide();
				$('div#transfer-type-account').show();
			}
			else if (v === 'USER') {
				$('div#transfer-type-account').hide();
				$('div#transfer-type-user').show();
			}
		});
	});
</script>


<div class="note">
	<div class="note-title">General information</div>
	<div class="note-body">
		<div class="table border">
			<div class="row">
				<div class="w250">All time credited</div>
				<div><?php echo $balance['total']; ?> PTS</div>
			</div>
			<div class="row">
				<div class="w250">Total credits</div>
				<div><?php echo $balance['payments']; ?> (<a href="<?php echo @Power::url('logs'); ?>">View report</a>)</div>
			</div>
			<div class="row">
				<div class="w250">Your current balance</div>
				<div><b><?php echo $balance['current']; ?> PTS</b></div>
			</div>
		</div>
	</div>
</div>



<div class="note">
	<div class="note-title">Point Transfer</div>
	<div class="note-body">
		<?php if(Config::get('points_transfer_enable') == 1) : $form=$this->beginWidget('CActiveForm'); echo CHtml::errorSummary($post); echo @Power::message('message-transfer'); ?>
		<div class="table">
			<div class="row">
				<div class="w0"><?php echo $form->dropDownList($post,'type', array('ACCOUNT'=>'Game account', 'USER'=>'To user')); ?></div>
				<div id="transfer-type-account" class="sh10"><?php echo $form->dropDownList($post,'recipient_account', @Power::getUserAccounts(), array('empty' => '-- Choose account --', 'class'=>' w180')); ?></div>
				<div id="transfer-type-user" class="sh10"><?php echo $form->textField($post,'recipient_user', array('class'=>'text', 'placeholder'=>'Enter username')); ?></div>
				<div><?php echo $form->label($post,'sum')?></div>
				<div class="sh10"><?php echo $form->textField($post,'sum', array('class'=>'text w90')); ?></div>
				<div><?php echo CHtml::submitButton('Transfer', array('class'=>'button')); ?></div>
			</div>
		</div>
		<?php $this->endWidget(); else: ?>
			Point transfer disabled by administration
		<?php endif; ?>
	</div>
</div>
