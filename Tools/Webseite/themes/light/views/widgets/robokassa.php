<script>
	$(document).ready(function(){
		$('#robokassa').submit(function(){
			$.ajax({
				url: "<?php echo @Power::url('robokassa/getsign'); ?>",
				data: {out_sum:$("input[name*='OutSum']").val()},
				dataType: 'json',
				cache: false,
				async: false,
				success: function(data){$("input[name*='SignatureValue']").val(data.sign)},
				error: function(data){alert('Signatur kann nicht generiert werden')}
			});
		});
	});
</script>


 <form id="robokassa" action="http://test.robokassa.ru/Index.aspx" method="post">
<!--<form action='https://auth.robokassa.ru/Merchant/Index.aspx' method="POST">-->
	<input type="text" name="OutSum" value="100" size="3" class="text pre" />
	<input type="hidden" name="MrchLogin" value="<?php echo $model['mrh_login']; ?>">
	<input type="hidden" name="Shp_account" value="<?php echo @Power::userId(); ?>">
	<input type="hidden" name="Desc" value="<?php echo $model['inv_desc']; ?>">
<!--	<input type="hidden" name="InvId" value=0> -->
<!--	<input type="hidden" name="Culture" value="ru">-->
	<input type="hidden" name="SignatureValue" value="">
	<input type="submit" value="Mit Robokassa bezahlen" class="button">
</form>