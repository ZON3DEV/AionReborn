<script>
	function setId(id, name) {
		$('#form-password')[0].reset();
		$(".note-result").text('');
		$('input[name="AccountForm[accountId]"]').val(id);
		$('span[name="accountName"]').text(name);
		$('#reset').attr({href: '<?php echo @Power::url('account/resetpassword'); ?>'+id});
	}
</script>


<div class="modal" id="modal-password">
	<div class="modal-window">
		<div class="modal-title">
			Account password change<span name="accountName"></span>
			<span class="modal-close" modal="modal-password">×</span>
		</div>
		<div class="modal-body">
			<div class="note-result"></div>
			<?php $form=$this->beginWidget('CActiveForm', array('id'=>'form-password')); ?>
			<div class="table">
				<div class="row">
					<div>Current password</div>
					<div class="w200"><input name="AccountForm[passwordCurrent]" type="text" class="text" /></div>
					<div><a id="reset" href="">Reset</a></div>
				</div>
				<div class="row">
					<div>New password</div>
					<div class="w200"><input name="AccountForm[passwordNew]" type="text" class="text" /></div>
				</div>
				<div class="row">
					<div>Confirm password</div>
					<div class="w200"><input name="AccountForm[passwordConfirm]" type="text" class="text" /></div>
				</div>
				<div class="row">
					<div></div>
					<div class="w200">
						<?php echo CHtml::ajaxSubmitButton('Change Password', CHtml::normalizeUrl(array('/account/changepassword/')), array('update'=>'.note-result'), array('live'=>false, 'class'=>'button')); ?>
						<input name="AccountForm[accountId]" type="hidden" />
					</div>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>