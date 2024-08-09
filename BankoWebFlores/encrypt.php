<?php 
require 'funcs/funcs.php';
$plaintext = "$2a$10$gH7Fzp9l3EKDLHefZtwuS.Vxhvsls2lE/60gnR3KuEgoWgb3E68C2";
$plaintext2 = "PHcsak4uMEVTY0MzIWRPL7XXllmUu/7havF2SysDWBoxEk+sALs0U8wtl3sq4aTjyQFKsXPxxCjYrjQ8QvYzJFsepNt9guk3xcdRejcXZcHUg8Jg2GXqLAVRPSqHUEHh";
$encrypted_text = decryptPayload($plaintext);


echo $encrypted_text;
