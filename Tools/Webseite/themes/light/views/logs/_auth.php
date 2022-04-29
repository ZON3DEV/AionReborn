<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#logs-auth').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": "<?php echo Power::url('logs/getAuthLogs'); ?>",
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aaSorting": [[ 3, "DESC" ]],
			"aoColumns": [{"mData": "ip_address"}, {"mData": "user_agent"}, {"mData": "status"}, {"mData": "date"}],
			"oLanguage": {"sUrl": "<?php echo Power::url('js/datatables-1.9.4/ru.txt'); ?>"}
		});
	});
</script>


<div class="note">
	<div class="note-title">Отчет о авторизациях</div>
	<div class="note-body">
		<table id="logs-auth" class="table">
			<thead>
			<tr>
				<th>IP адрес</th>
				<th>Браузер</th>
				<th>Статус</th>
				<th>Дата</th>
			</tr>
			</thead>
		</table>
	</div>
</div>