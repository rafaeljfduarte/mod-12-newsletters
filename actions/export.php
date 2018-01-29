<?php
function cleanData(&$str) {
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = "{$cfg->system->sitename}_newsletters_" . date('Ymd') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;
$query = sprintf(
	"SELECT email, name, company, areas, date FROM %s_newsletters WHERE active = '%s' ",
	$cfg->db->prefix, true
);

$source = $mysqli->query($query);
while($row = $source->fetch_assoc()) {
	if(!$flag) {
		// display field/column names as first row
		echo implode("\t", array_keys($row)) . "\r\n";
		$flag = true;
	}
	array_walk($row, __NAMESPACE__ . '\cleanData');
	echo implode("\t", array_values($row)) . "\r\n";
}
exit;
