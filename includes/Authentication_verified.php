
<?php
session_start();

$msg = "";
if (!isset($_SESSION['email'])) {
?>
  <script>
    window.location.href = '/Leave-Management-System/pages/login.php';
  </script>
<?php
}
?>