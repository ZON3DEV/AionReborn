<script>
	$(document).ready(function(){
		$('#interkassa').submit(function(){
			$.ajax({
				url: "<?php echo @Power::url('interkassa/getsign'); ?>",
				data: {
					ik_co_id:$("input[name*='ik_co_id']").val(),
					ik_desc:$("input[name*='ik_desc']").val(),
					ik_pm_no:$("input[name*='ik_pm_no']").val(),
					ik_am:$("input[name*='ik_am']").val(),
					ik_cur:$("input[name*='ik_cur']").val()
				},
				dataType: 'json',
				cache: false,
				async: false,
				success: function(data){$("input[name*='ik_sign']").val(data.sign)},
				error: function(data){alert('Невозможно сгенерировать подпись')}
			});
		});
	});
</script>


<form id="interkassa" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
	<input type="text" name="ik_am" value="100" size="3" class="text pre" />
	<input type="hidden" name="ik_co_id" value="<?php echo $model['ik_co_id']; ?>" />
	<input type="hidden" name="ik_pm_no" value="<?php echo @Power::userId(); ?>" />
	<input type="hidden" name="ik_cur" value="RUB" />
	<input type="hidden" name="ik_desc" value="<?php echo $model['ik_desc']; ?>" />
	<input type="hidden" name="ik_sign" value="">
	<input type="submit" value="Оплатить с помощью Интеркассы" class="button">
</form>