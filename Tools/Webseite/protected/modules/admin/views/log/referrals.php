<?php

	$this->setPageTitle( 'Refferals' );
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
	echo @Power::url( 'admin/log/referrals' );
	echo '\',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[3, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"user"},
				{"aTargets":[1], "mData":"referral"},
				{"aTargets":[2], "mData":"status"},
				{"aTargets":[3], "mData":"created", "bSearchable":false},
				{"aTargets":[4], "mData":"completed", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Refferals';
	echo '</div>
		<div class="note-body">
			<table id="logs" class="table">
				<thead>
				<tr>
					<th>User</th>
					<th>Referral</th>
					<th>Status</th>
					<th width="150px">Created</th>
					<th width="150px">Enrolled</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>