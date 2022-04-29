<?php

	$this->setPageTitle( 'Authorization logs' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#logs\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"sAjaxSource": \'';
	echo @Power::url( 'admin/log/auth' );
	echo '\',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[5, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"login"},
				{"aTargets":[1], "mData":"ip_address"},
				{"aTargets":[2], "mData":"user_agent"},
				{"aTargets":[3], "mData":"type"},
				{"aTargets":[4], "mData":"status"},
				{"aTargets":[5], "mData":"date", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">';
	echo 'Authorization logs</div>
		<div class="note-body">
			<table id="logs" class="table">
				<thead>
				<tr>
					<th>Login</th>
					<th>IP address</th>
					<th>Browser</th>
					<th width="100px">Type</th>
					<th width="120px">Status</th>
					<th width="120px">Date</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>