<?php

	$this->setPageTitle( 'Mail list' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var oTable = $(\'#mail\').dataTable({
			"bProcessing": true,
			"bServerSide": true,
			"bDeferRender": true,
			"bLengthChange": true,
			"fnServerData": function (sSource, aoData, fnCallback) {
				$.getJSON(sSource, aoData, function (json) {
					fnCallback(json);
					tooltips();
					ajaxButton();
					';
	echo 'aionLink();
				});
			},
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"aaSorting": [[7, "desc"]],
			"oLanguage": {"sUrl": "';
	echo @Power::url( 'js/datatables-1.9.4/ru.txt' );
	echo '"},
			"aoColumnDefs": [
				{"aTargets":[0], "mData":"sender_name"},
				{"aTargets":[1], "mData":"recipient_name"},
				{"aTargets":[2], "mData": "mail_title", "mRender": function (data, type, full) {return \'<img src="';
	echo @Power::url( 'images/mail.png' );
	echo '" title="\'+data+\'" />\';}},
				{"aTargets":[3], "mData": "mail_message", "mRender": function (data, type, full) {return \'<img src="';
	echo @Power::url( 'images/mail.png' );
	echo '" title="\'+data+\'" />\';}},
				{"aTargets":[4], "mData":"item_id", "mRender": function (data, type, full) {return \'<a class="aion-item-icon-large"><a href="http://aiona.net/item/\'+data+\'">\'+data+\'</a>\';}},
				{"aTargets":[5], "mData":"item_count"},
				{"aTargets":[6], "mData":"express", "bSearchable":false},
				{"aTargets":[7], "mData":"recieved_time", "bSearchable":false},
				//{"aTargets":[8], "mData":';
	echo '"mail_unique_id", "bSearchable":false, "mRender": function (data, type, full) {return \'';
	echo '<s';
	echo 'pan url="';
	echo @Power::url( 'admin/mail/delete' );
	echo '"\'+data+\' confirm="Delete email" class="ajaxbutton" title="Delete"><i class="btn-delete"></i></span>\';}}
			]
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Mail list</div>
		<div class="note-body">
			<table id="mail" class="table">
				<thead>
				<tr>
					<th width="170px">Sender</th>
					<th ';
	echo 'width="170px">Recipient</th>
					<th width="50px">Tittle</th>
					<th width="50px">Message</th>
					<th width="50px">Objects</th>
					<th width="60px">Qty</th>
					<th width="60px">Type</th>
					<th width="150px">Sent</th>
<!--					<th width="50px">Delete</th>-->
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>';
?>