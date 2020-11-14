<?php
    include 'includes/head.php';
    include 'includes/header.php';
?>

<style type = "text/css">
    h4 {color: #004d40;}
    h6 {color: #004d40;}
    black {color: #212121;}
    
</style>

<h4> &nbsp &nbsp <i class="small material-icons"> chat </i> 식당검색 및 조회 </h4>
<br>

<form action = "Search Restaurant.php", method = "post">
    <h6> &nbsp &nbsp &nbsp <i class = "tiny material-icons"> details </i> 검색 기준 </h6>
    <div class = "row" name = "searchOption">
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "restNameOption"/><span><black>식당</black></span> </label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "typeOption"/><span><black>음식종류</black></span></label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "menuOption"/><span><black>메뉴</black></span></label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "priceOption"/><span><black>가격대</black></span></label>
    </div>
    <br><br>
    <?php
        $restNameOption = $_POST['restNameOption'];
        $typeOption = $_POST['typeOption'];
        $menuOption = $_POST['menuOption'];
        $priceOption = $_POST['priceOption'];
    ?>
    <div>
    <?php 
        if (!empty($_POST['restNameOption'])) { ?>
        <div class = "row">
            <div class = "input-field col s3">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <black>식당 이름</black>: <input type = "text" name = "restaurant_name">
            </div>
            &nbsp &nbsp &nbsp <input type = "submit" value = '검색'>
        </div>
        <?php } ?>
    </div>
    <input type="checkbox" name="color" value="red">
    <p><input type="submit" value="Submit"> <input type="reset" value="Reset"></p>
</form>

</body>
</html>