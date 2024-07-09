
<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $db->escape_string($_GET['delete_id']);
    $db->query("DELETE FROM tahun_akademik WHERE id ='$delete_id'");
    header("Location: index.php");
    exit();
}
?>