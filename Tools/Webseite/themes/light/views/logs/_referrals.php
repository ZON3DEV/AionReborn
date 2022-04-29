<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#logs').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": "<?php echo Power::url('logs/getreferralslogs'); ?>",
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aaSorting": [[ 3, "DESC" ]],
			"aoColumns": [{"mData": "login"}, {"mData": "status"}, {"mData": "created"}, {"mData": "completed"}],
			"oLanguage": {"sUrl": "<?php echo Power::url('js/datatables-1.9.4/ru.txt'); ?>"}
		});
	});
</script>


<div class="note">
	<div class="note-title">Отчет о регистрации рефералов</div>
	<div class="note-body">
		<table id="logs" class="table">
			<thead>
			<tr>
				<th>Аккаунт</th>
				<th>Статус</th>
				<th width="130px">Регистрация</th>
				<th width="130px">Зачислен</th>
			</tr>
			</thead>
		</table>
	</div>
</div>