<?php
include __FILE__ . '/components/header.php';
$year = date('Y');
$month = date('n');
header("Location: /month?y=$year&m=$month");
include __FILE__ . '/components/footer.php';
