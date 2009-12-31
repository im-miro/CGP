<?php

# Collectd Memory plugin

require_once 'conf/common.inc.php';
require_once 'type/GenericStacked.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# memory/
# memory/memory-buffered.rrd
# memory/memory-cached.rrd
# memory/memory-free.rrd
# memory/memory-used.rrd

$obj = new Type_GenericStacked($CONFIG['datadir']);
$obj->order = array('free', 'buffered', 'cached', 'used');
$obj->ds_names = array(
	'free' => 'Free    ',
	'cached' => 'Cached  ',
	'buffered' => 'Buffered',
	'used' => 'Used    ',
);
$obj->colors = array(
	'free' => '00e000',
	'cached' => '0000ff',
	'buffered' => 'ffb000',
	'used' => 'ff0000',
);
$obj->width = $width;
$obj->heigth = $heigth;

$obj->rrd_title = 'Physical memory utilization';
$obj->rrd_vertical = 'Bytes';
$obj->rrd_format = '%5.1lf%s';

collectd_flush($obj->identifiers);
$obj->rrd_graph();

?>