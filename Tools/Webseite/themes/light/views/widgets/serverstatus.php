<script>
	$('document').ready(function serverStatus() {
		var b = $('span.server-status-refresh');
		var url = b.attr('url');
		$(b).click(serverStatus);
		$.ajax({
			url: url,
			dataType: "json",
			cache: false,
			async: true,
			beforeSend: function() {
				$('.login-server-status, .game-server-status').removeClass('server-status-online server-status-offline');
				$('.login-server-status, .game-server-status').addClass('ajax-loading');
			},
			success: function(data) {
				$('.login-server-status').addClass('server-status-'+data.login);
				$('.game-server-status').addClass('server-status-'+data.game);
			},
			error: function(result) {
				$('.login-server-status, .game-server-status').removeClass('ajax-loading');
				$('.login-server-status, .game-server-status').addClass('ajax-error');
			}
		});
	})
</script>


<div id="server-status">
	Authentikation: <span class="login-server-status"></span>
	Welt Server: <span class="game-server-status"></span>
	<span class="server-status-refresh" url="<?php echo @Power::url('api/serverstatus'); ?>" title="Status aktualisieren"></span>
</div>