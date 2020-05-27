<?php
//prevent access to directory listing on badly configurated server.
$z="HTTP/1.0 404 Not Found";header($z);die($z);

