<?php 
require 'funcs/funcs.php';
$plaintext = "";
$plaintext2 = "PHcsak4uMEVTY0MzIWRPL7XXllmUu/7havF2SysDWBoxEk+sALs0U8wtl3sq4aTjyQFKsXPxxCjYrjQ8QvYzJFsepNt9guk3xcdRejcXZcHUg8Jg2GXqLAVRPSqHUEHh";
$encrypted_text = decryptPayload($plaintext2);


echo $encrypted_text;