<?php

	$this->setPageTitle( 'Premium Purchasing' );
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
	echo @Power::url( 'admin/log/membership' );
	echo '\',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[3, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"name"},
				{"aTargets":[1], "mData":"login"},
				{"aTargets":[2], "mData":"account_name"},
				{"aTargets":[3], "mData":"date", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Premium Purchasing</div>
		<div class="note-body">
			<table id="logs"';
	echo ' class="table">
				<thead>
				<tr>
					<th width="260px">Account</th>
					<th width="200px">User</th>
					<th width="200px">Account</th>
					<th width="150px">Date</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>