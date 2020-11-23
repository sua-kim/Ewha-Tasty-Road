<?php
    include "includes/database.php";

    $sql = "start transaction";
    $conn -> query($sql);

    $rest_id = $_GET['id'];

    $sql = "DELETE from foodtype where menu_id = (select menu_id from menu where restaurant_id = '".$rest_id."');";
    $conn -> query($sql);
    $sql = "DELETE from menu where restaurant_id = '".$rest_id."';";
    $conn -> query($sql);
    $sql = "DELETE from restaurant where restaurant_id = '".$rest_id."';";
    $conn -> query($sql);

    $sql = "commit";
    $conn -> query($sql);
?>
<script type="text/javascript">alert("삭제되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/RESTAURANT_WEBSITE/restaurant list.php">