<?php

	$this->setPageTitle( 'Legion List' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#legions\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"sAjaxSource": \'';
	echo @Power::url( 'admin/legion' );
	echo '\',
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[0, "asc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"name"},
				{"aTargets":[1], "mData":"legat"},
				{"aTargets":[2], "mData":"race", "bSearchable":false},
				{"aTargets":[3], "mData":"level"},
				{"aTargets":[4], "mData":"contribution_points", "bSearchable":false},
				{"aTargets":[5], "mData":"members_count", "bSearchable":false}
			]
		});
	});
</script>


<div class="note-bo';
	echo 'rder">
	<div class="note">
		<div class="note-title">Legion List</div>
		<div class="note-body">
			<table id="legions" class="table">
				<thead>
				<tr>
					<th width="204px">Legion Name</th>
					<th width="204px">Legate</th>
					<th width="100px">Race</th>
					<th width="100px">Level</th>
					<th width="100px">Abbys Points</th>
					<th width="100px">Members';
	echo '</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>