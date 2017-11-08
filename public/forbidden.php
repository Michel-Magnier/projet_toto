<?php

require_once __DIR__.'/../inc/config.php';

http_response_code(404);

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/forbidden.php';
require_once __DIR__.'/../view/footer.php';
?>
