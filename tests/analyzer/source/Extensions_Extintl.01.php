<?php
$coll  = collator_create('en_US');
$result = collator_compare($coll, "string#1", "string#2");
?>