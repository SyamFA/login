<?php
session_start();
session_unset(); //menghapus semua variabel session.
session_destroy();//menghapus session.

header("Location: index.php");
exit;
?>