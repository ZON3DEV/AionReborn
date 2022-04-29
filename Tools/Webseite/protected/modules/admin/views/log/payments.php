<?php

	$this->setPageTitle( 'Balance Purchasing' );
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
	echo @Power::url( 'admin/log/payments' );
	echo '\',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[5, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"payment_id"},
				{"aTargets":[1], "mData":"system"},
				{"aTargets":[2], "mData":"login"},
				{"aTargets":[3], "mData":"sum"},
				{"aTargets":[4], "mData":"status"},
				{"aTargets":[5], "mData":"date", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">';
	echo 'Balance Purchasing</div>
		<div class="note-body">
			<table id="logs" class="table">
				<thead>
				<tr>
					<th width="120px">Payment Number</th>
					<th>System</th>
					<th>User</th>
					<th width="100px">Amount</th>
					<th width="120px">Status</th>
					<th width="120px">Date</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</di';
	echo 'v>';
?>