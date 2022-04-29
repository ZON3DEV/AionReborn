<?php $this->setPageTitle('Reports'); ?>

<div class="note">
	<div class="note-title">Reports</div>
	<div class="note-body">
		<div class="mb10">
			<?php echo @CHtml::ajaxLink('Login', @CController::createUrl('logs/viewauthlogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
			<?php echo @CHtml::ajaxLink('Top up balanceа', @CController::createUrl('logs/viewpaymentslogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
			<?php echo @CHtml::ajaxLink('Point Transfer', @CController::createUrl('logs/viewtransferlogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
			<?php echo @CHtml::ajaxLink('Web Shop Shopping', @CController::createUrl('logs/viewwebshoplogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
		</div>
		<div>
			<?php echo CHtml::ajaxLink('Premium Buying', @CController::createUrl('logs/viewmembershiplogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
			<?php echo CHtml::ajaxLink('Top Voting', @CController::createUrl('logs/viewvoteslogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
			<?php echo CHtml::ajaxLink('Registration of referrals', @CController::createUrl('logs/viewreferralslogs/'), array('update'=>'#logs-content'), array('class'=>'button')); ?>
		</div>
	</div>
</div>

<div id="logs-content"></div>