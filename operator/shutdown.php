<?php

// Execute the shutdown command
$output = shell_exec('sudo shutdown -h now');

// Output the result
echo "<pre>$output</pre>";

?>
