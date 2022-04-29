<?php

// Adding restart time
$restart = array(
	'12:00',
	'00:00',
);


sort($restart, SORT_NUMERIC);
function rest($restart, $now) {
	foreach ($restart AS $res) {
		if (strtotime($res) > $now) {
			$next = strtotime($res);
			return $next;
		}
	}
	if (!$next) return strtotime($restart[0]) + 86400;
}
function remain($next, $now) {
	$remain = $next - $now;
	$h = intval($remain / 3600);
	$m = intval($remain / 60) % 60;
	$s = intval($remain % 60);
	return $h.' ч. '.$m.' мин. '.$s.' сек.';
}
$now = strtotime(date('H:i:s', time()));
$timer['time'] = date('H:i', time());
$timer['next'] = date('H:i:s', rest($restart, $now));
$timer['remain'] = remain(rest($restart, $now), $now);
$timer['restart'] = $restart;
echo json_encode($timer);