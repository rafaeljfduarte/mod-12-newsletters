<?php
header('Location: '.$cfg->system->path_bo.'/'.$lg.'/12-newsletters/');

$object_newsletters = new newsletter();
$object_newsletters->setId($id);
$object_newsletters->disable();

exit;
