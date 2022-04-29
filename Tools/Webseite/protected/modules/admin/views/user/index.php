<?php

	$this->setPageTitle( 'List Of Users' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#users\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"sAjaxSource": \'';
	echo @Power::url( 'admin/user' );
	echo '\',
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[5, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"login"},
				{"aTargets":[1], "mData":"email"},
				{"aTargets":[2], "mData":"group_id", "bSearchable":false},
				{"aTargets":[3], "mData":"ip_address"},
				{"aTargets":[4], "mData":"money", "bSearchable":false},
				{"aTargets":[5], "mData":"created", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<d';
	echo 'iv class="note">
		<div class="note-title">List Of Users</div>
		<div class="note-body">
			<table id="users" class="table">
				<thead>
				<tr>
					<th width="150px">Username</th>
					<th width="150px">E-mail Address</th>
					<th width="100px">Group</th>
					<th width="150px">IP address</th>
					<th width="100px">Balance</th>
			';
	echo '		<th width="150px">Check In</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>