<?php

session_start();

session_destroy();

'<script language="javascript">alert("Has cerrado sesión);</script>';
header("location: ../login.php");

exit();

?>