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
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "restaurant" value = "restaurant"/><span><black>식당</black></span> </label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "foodtype" value = "foodtype"/><span><black>음식종류</black></span></label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "menu" value = "menu"/><span><black>메뉴</black></span></label>
        &nbsp &nbsp &nbsp <label><input type = "checkbox" name = "price" value = "price"/><span><black>가격대</black></span></label>
        &nbsp &nbsp &nbsp <label><input type = "submit" name = "선택 완료" value = "선택 완료">
    </div>
</form>
<br>
<?php
    // options are received in variables through '$_post', if not checked save as null value
    $restaurant = isset($_POST['restaurant']) ? $_POST['restaurant'] : '';
    $foodtype = isset($_POST['foodtype']) ? $_POST['foodtype'] : '';
    $menu = isset($_POST['menu']) ? $_POST['menu'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
?>

<form>
    <?php if (!empty($restaurant)) { // display the input form when selecting '식당' option ?>
        <!-- create input text box to get name of restaurant -->
        <div class = "row">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <black>식당 이름 : </black>
            <div class = "input-field inline">
            &nbsp &nbsp &nbsp &nbsp <input type = "text" name = "restaurant_name">
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($foodtype)) { // display the input form when selecting '음식종류' option ?>
        <!-- create selection box to get foodtype -->
        <div class = "row">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <black>음식 종류 : </black>
            <div class = "input-field inline">
                <select class="browser-default" name = "foodtype_id">
                    <option value="none">메뉴 분류를 선택해주세요</option>
                    <option value="한식">한식</option>
                    <option value="분식">분식</option>
                    <option value="일식">일식</option>
                    <option value="중식">중식</option>
                    <option value="양식">양식</option>
                    <option value="아시안">아시안</option>
                    <option value="카페">카페</option>
                    <option value="주점">주점</option>
                </select>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($menu)) { // display the input form when selecting '메뉴' option ?>
        <!-- create input text box to get menu -->
        <div class = "row">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <black>메뉴명 : </black>
            <div class = "input-field inline">
            &nbsp &nbsp &nbsp &nbsp <input type = "text" name = "menu_name">
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($price)) { // display the input form when selecting '가격대' option ?>
        <!-- create input number box to get minimum and maximum price -->
        <div class = "row">
            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <black>가격대 : </black>
            <div class="input-field inline">
                <input placeholder="  최소" type="number" name="lowest_price">
            </div>
            <div class = "input-field inline">
            &nbsp &nbsp <black> ~ </black> &nbsp &nbsp
            </div>
            <div class="input-field inline">
                <input placeholder="  최대" type="number" name="highest_price">
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($restaurant) || !empty($foodtype) || !empty($menu) || !empty($price)) { ?>
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <input type = "submit" value = '검색'>
    <?php } ?>


</form>



</body>
</html>
