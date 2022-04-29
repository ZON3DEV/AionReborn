<?php

	$this->setPageTitle( 'WebShop List of Things' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#webshop\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"sAjaxSource": \'';
	echo @Power::url( 'admin/webshop' );
	echo '\',
			"fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
					ajaxButton();
					console.log(json);
					aionLink();
				} );
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[0, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"item_id"},
				{"aTargets":[1], "mData":"category_name"},
				{"aTargets":[2], "mData":"quantity", "bSearchable":false},
				{"aTargets":[3], "mData":"price", "bSearchable":false},
				{"aTargets":[4], "mData":null, "bSearchable":false, "bSortable":false, "mRender": function (data, type, full) {
					var e = \'<a href="';
	echo @Power::url( 'admin/webshop/edit' );
	echo '\'+full.id+\'" class="btn mr10" title="Edit"><i class="btn-edit"></i></a>\';
					var d = \'';
	echo '<s';
	echo 'pan url="';
	echo @Power::url( 'admin/webshop/delete' );
	echo '\'+full.id+\'" class="ajaxbutton" title="Delete"><i class="btn-delete"></i></span>\';
					return e+\' \'+d;
				}}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">WebShop List of Things</div>
		<div class="note-body">
			<table id="webshop" class="table ftl">
				<thead>
				<tr>
					<th>Title</th>
					<th wi';
	echo 'dth="130px">Category</th>
					<th width="90px">Quantity</th>
					<th width="90px">Price</th>
					<th width="90px">Operations</th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>