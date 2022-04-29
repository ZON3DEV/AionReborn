<?php

	$this->setPageTitle( 'Point Transfer' );
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
	echo @Power::url( 'admin/log/transferpoints' );
	echo '\',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[4, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"sender"},
				{"aTargets":[1], "mData":"recipient_account"},
				{"aTargets":[2], "mData":"recipient_user"},
				{"aTargets":[3], "mData":"sum"},
				{"aTargets":[4], "mData":"date", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Point Transfer';
	echo '</div>
		<div class="note-body">
			<table id="logs" class="table">
				<thead>
				<tr>
					<th>Sender</th>
					<th>Account</th>
					<th>User</th>
					<th>Amount</th>
					<th width="150px">Date</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>