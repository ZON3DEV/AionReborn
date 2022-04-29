<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#logs-auth').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": "<?php echo Power::url('logs/getmembershiplogs'); ?>",
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aaSorting": [[ 3, "DESC" ]],
			"aoColumns": [{"mData": "account_name"}, {"mData": "membership_name"}, {"mData": "price"}, {"mData": "date"}],
			"oLanguage": {"sUrl": "<?php echo Power::url('js/datatables-1.9.4/ru.txt'); ?>"}
		});
	});
</script>


<div class="note">
	<div class="note-title">Отчет о покупках премиумов</div>
	<div class="note-body">
		<table id="logs-auth" class="table">
			<thead>
			<tr>
				<th>Аккаунт</th>
				<th>Премиум</th>
				<th>Цена</th>
				<th width="120px">Дата</th>
			</tr>
			</thead>
		</table>
	</div>
</div>