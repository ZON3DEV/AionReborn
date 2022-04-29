<?php

	$this->setPageTitle( 'Character List' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#players\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"sAjaxSource": \'';
	echo @Power::url( 'admin/player' );
	echo '\',
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[ 0, "asc" ]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"name"},
				{"aTargets":[1], "mData":"account_name"},
				{"aTargets":[2], "mData":"exp", "bSearchable":false},
				{"aTargets":[3], "mData":"race"},
				{"aTargets":[4], "mData":"player_class"},
				{"aTargets":[5], "mData":"creation_date", "bSearchable":false},
				{"aTargets":[6], "mData":"last_online", "bSearchable":false},
				{"';
	echo 'aTargets":[7], "mData":"online", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Character List</div>
		<div class="note-body">
			<table id="players" class="table">
				<thead>
				<tr>
					<th>Character Name</th>
					<th>Account</th>
					<th>Level</th>
					<th>Race</th>
					<th>';
	echo 'Class</th>
					<th>Date Created</th>
					<th>Online</th>
					<th>Status</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>