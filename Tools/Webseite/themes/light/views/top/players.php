<?php $this->setPageTitle('Top Player'); ?>


<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $('#top-players').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": '<?php echo @Power::url('top/players'); ?>',
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) { 
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[ 1, "desc" ], [ 2, "desc" ]],
			"aoColumns": [{"mData": "name"}, {"mData": "exp"}, {"mData": "ap"}, {"mData": "all_kill"}, {"mData": "race"}, {"mData": "player_class"}, {"mData": "online"}],
			"oLanguage": {"sUrl": "<?php echo @Power::url('js/datatables-1.9.4/ru.txt'); ?>"},
			"aoColumnDefs": [
				{"aTargets": [0], "mData": "inventory", "mRender": function (data, type, full) {return '<a href="<?php echo @Power::url('player'); ?>'+data+'">'+data+'</a>';}},
			],
		});
	});
</script>


<div class="note">
	<div class="note-title">Top Player</div>
	<div class="note-body">
		<table id="top-players" class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th width="80px">Level</th>
					<th width="80px">AP</th>
					<th width="80px">Kills</th>
					<th width="80px">Race</th>
					<th width="80px">Class</th>
					<th width="80px">Online</th>
				</tr>
			</thead>
		</table>
	</div>
</div>