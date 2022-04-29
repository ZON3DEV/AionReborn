<script>
	function updPrice(a) {
		var cntOne = parseInt($('#itemInfo').attr('count'));
		var prOne = parseInt($('#itemInfo').attr('price'));
		var one = prOne / cntOne;
		one = one.toFixed(1);
		var cnt = parseInt($('#itemAmount').val());
		if (a == 'inc') {
			cnt = cnt + 1;
		}
		else if (a == 'dec') {
			if (cnt <= 1) cnt = 1;
			else cnt = cnt - 1;
		}
		var res = cnt * one;
		res = res.toFixed(1);
		res = Math.ceil(res);
		$('#itemPrice').text(res);
		$('#itemAmount').val(cnt);
	}
	$('document').ready(function(){
		$('i.btn-point-gold').click(function(){
			var el = $(this);
			var itemId = el.attr('itemId');
			var chc = el.attr('changeCount');
			var tr = el.parents('tr');
			var item = tr.children('td').html();
			var cnt = tr.children('td').next().html();
			var pr = tr.children('td').next().next().html();
			$('#form-buy')[0].reset();
			$('div[name="itemName"]').text('');
			$(".note-result").text('');
			$('div[name="itemName"]').append(item);
			$('#itemAmount').val(cnt);
			$('#itemPrice').text(pr);
			$('input#itemInfo').attr('count', cnt);
			$('input#itemInfo').attr('price', pr);
			$('input#itemId').val(itemId);
			if (chc == '0') $("#webshop-count").html('<span class="disabled-count">amount: '+cnt+'</span>');
		});
		$("input#itemAmount").blur(function(){
			var cnt = parseInt($('#itemAmount').val());
			if (cnt <= 1) cnt = 1;
			$('#itemAmount').val(cnt);
			updPrice();
		});
	});
</script>


<div class="modal" id="modal-buy">
	<div class="modal-window">
		<div class="modal-title">
			Purchase item
			<span class="modal-close" modal="modal-buy">×</span>
		</div>
		<div class="modal-body">
			<div class="note-result"></div>
			<div class="webshop-item" name="itemName"></div>
			<?php $form=$this->beginWidget('CActiveForm', array('id'=>'form-buy')); ?>
				<div class="table">
					<div class="row">
						<div class="w200">
							<div id="webshop-count">
								<span class="count-btn" id="itemAmountDec" onclick="updPrice('dec')">-</span>
								<input class="count-input" id="itemAmount" name="WebshopForm[itemCount]" type="text" value="0" />
								<span class="count-btn" id="itemAmountInc" onclick="updPrice('inc')">+</span>
							</div>
						</div>
						<div>
							<div class="webshop-price" id="itemPrice">0</div> <span class="btn-point-gold s16"></span>
							<input type="hidden" id="itemInfo" count="0" price="0" />
							<input id="itemId" name="WebshopForm[itemId]" type="hidden" value="0" />
						</div>
					</div>
					<div class="row">
						<div class="w200">
							<select name="WebshopForm[playerId]" id="selectPlayer">
								<option value="0">-- Choose a character --</option>
								<?php foreach ($players as $key=>$value): ?>
									<optgroup label="Account <?php echo $key; ?>">
										<?php foreach ($value as $data): ?>
											<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
										<?php endforeach; ?>
									</optgroup>
								<?php endforeach; ?>
							</select>
						</div>
						<div>
							<?php echo CHtml::ajaxSubmitButton('Purchase', @Power::url('webshop/buy'), array('update'=>'.note-result'), array('live'=>true, 'class'=>'button')); ?>
						</div>
					</div>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>