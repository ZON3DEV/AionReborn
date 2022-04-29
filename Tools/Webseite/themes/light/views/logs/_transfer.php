<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $('#logs-auth').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": '<?php echo Power::url('logs/gettransferlogs'); ?>',
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aaSorting": [[3, "desc"]],
			"oLanguage": {"sUrl": "<?php echo Power::url('js/datatables-1.9.4/ru.txt'); ?>"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"recipient_account"},
				{"aTargets":[1], "mData":"recipient_user"},
				{"aTargets":[2], "mData":"sum"},
				{"aTargets":[3], "mData":"date", "bSearchable":false}
			]
		});
	});
</script>


<div class="note">
	<div class="note-title">Отчет о передачи поинтов</div>
	<div class="note-body">
		<table id="logs-auth" class="table">
			<thead>
			<tr>
				<th>Аккаунт</th>
				<th>Пользователь</th>
				<th>Сумма</th>
				<th width="150px">Дата</th>
			</tr>
			</thead>
		</table>
	</div>
</div>