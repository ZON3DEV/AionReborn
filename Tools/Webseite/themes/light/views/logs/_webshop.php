<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#logs-auth').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"bFilter": false,
			"bInfo": false,
			"sAjaxSource": "<?php echo Power::url('logs/getwebshoplogs'); ?>",
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					aionLink();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aaSorting": [[ 3, "DESC" ]],
			"aoColumns": [{"mData": "item_id"}, {"mData": "quantity"}, {"mData": "price"}, {"mData": "date"}],
			"oLanguage": {"sUrl": "<?php echo Power::url('js/datatables-1.9.4/ru.txt'); ?>"},
			"aoColumnDefs": [
				{"aTargets": [0], "mData": "item_id", "mRender": function (data, type, full) {return '<a class="aion-item-icon-large"><a href="http://aiondb.ru/items/'+data+'">'+data+'</a>';}}
			]
		});
	});
</script>


<div class="note">
	<div class="note-title">Отчет о покупках в веб-шопе</div>
	<div class="note-body">
		<table id="logs-auth" class="table">
			<thead>
			<tr>
				<th>Вещь</th>
				<th>Кол-во</th>
				<th>Сумма</th>
				<th>Дата</th>
			</tr>
			</thead>
		</table>
	</div>
</div>