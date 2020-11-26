<?php
    include 'includes/head.php';
    include 'includes/header.php';
?>

<style type = "text/css">
    h4 {color: #004d40;}
    subtitle {font-size: 1.2rem; color: #004d40;}
    black {font-size: 1.1rem; color: #000000;}
</style>

<?php
    // Database integration
    require 'includes/database.php';

    // 
    $rest_id = $_GET['id'];
    // Take restaurant information from database
    $sql = "SELECT * from restaurant where restaurant_id = '".$rest_id."'";
    $sql = $conn -> query($sql);
    $restaurant = $sql->fetch_array();

?>

<h4>&nbsp &nbsp <i class="small material-icons">assistant</i> <?php echo $restaurant["restaurant_name"];?></h4>
    &nbsp &nbsp &nbsp &nbsp &nbsp <a href = "Update Restaurant.php?id=<?=$rest_id?>" class="waves-effect waves-light btn">식당 정보 수정</a>
<br><br>
<?php
    $sql_num = "SELECT count(review_id) from review, menu where restaurant_id = '".$rest_id."' and menu.menu_id = review.menu_id";
    $sql_num = $conn -> query($sql_num);
    $sql_num = $sql_num->fetch_array();
    if ($sql_num['count(review_id)'] > 0) {
        $sql_strength = "SELECT avg(review_rate_taste) as taste, avg(review_rate_turnover) as turnover, avg(review_rate_clean) as clean, avg(review_rate_service) as service 
                        from review, menu 
                        where restaurant_id = '".$rest_id."' and menu.menu_id = review.menu_id";
        $sql_strength = $conn -> query($sql_strength);
        $review_strength = $sql_strength->fetch_array();
        $max_strength = max($review_strength);
        $strength = array_search($max_strength, $review_strength);
        switch($strength) {
            case 0:
                $strength = '맛';
            break;
            case 1:
                $strength = '회전율';
            break;
            case 2:
                $strength = '청결';
            break;
            case 3:
                $strength = '서비스';
            break;
        };
?> 
<subtitle>&nbsp &nbsp &nbsp 이 식당은 <?php echo $strength ?>부문이 높게 평가 받는 식당입니다! </subtitle> <br>
<?php }; ?>
 <br>
<subtitle>&nbsp &nbsp &nbsp (1) 소개 </subtitle> <br> 
    <div class="card-panel grey lighten-5">
    <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $restaurant["restaurant_description"];?></black>
    </div> <br>
<subtitle>&nbsp &nbsp &nbsp (2) 전화번호 </subtitle> <br> 
    <div class="card-panel grey lighten-5">
    <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $restaurant["restaurant_phone"];?></black>
    </div> <br>
<subtitle>&nbsp &nbsp &nbsp (3) 위치 </subtitle> <br> 
    <div class="card-panel grey lighten-5">
    <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $restaurant["restaurant_location"];?></black> 
    </div><br>
<subtitle>&nbsp &nbsp &nbsp (4) 영업시간 </subtitle> <br>
    <div class="card-panel grey lighten-5">
    <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $restaurant["restaurant_opening"];?></black> 
    </div><br>
<subtitle>&nbsp &nbsp &nbsp (5) 휴무일 </subtitle> <br>
    <div class="card-panel grey lighten-5">
    <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $restaurant["restaurant_close"];?></black>
    </div><br>
<div class = "row">
<subtitle>&nbsp &nbsp &nbsp (6) 메뉴 및 가격 &nbsp &nbsp </subtitle>
</div>
    <?php
        $sql_avg = "SELECT restaurant_id, AVG(menu_price) AS avgprice from menu where restaurant_id = '".$rest_id."'";
        $sql_avg = $conn -> query($sql_avg);
        $avg_price = $sql_avg -> fetch_array();
    ?>
<div class = 'container'>
    <black> &#9193 이 가게의 평균 가격은 &nbsp &nbsp<?php echo round($avg_price["avgprice"]); ?>원 입니다.</black>
    <br><br>
    <div id = "restaurant_list">
    <table class="highlight">
        <thead>
        <tr>
            <th>메뉴 구분</th>
            <th>메뉴 이름</th>
            <th>메뉴 가격</th>
        </tr>
        </thead>
        <?php
            $sql_menu = "SELECT foodtype_id, menu_name, menu_price from menu, foodtype where restaurant_id = '".$rest_id."' and menu.menu_id=foodtype.menu_id";
            $sql_menu = $conn -> query($sql_menu);
            while($menu = $sql_menu->fetch_array()) {
        ?>
        <tbody>
        <tr>
            <td> <?=$menu['foodtype_id']; ?> </td>
            <td> <?=$menu['menu_name']; ?> </td>
            <td> <?=$menu['menu_price']; ?> </td>
        </tr>
        </tbody>
            <?php }; ?>
    </table> <br> </div>
</div>

</body>
</html>