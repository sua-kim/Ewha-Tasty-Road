<?php
    include 'includes/head.php';
    include 'includes/header.php';
?>

<style type = "text/css">
    h4 {color: #004d40;}
    form {font-size: 1.2rem; color: black;}
</style>

<h4> &nbsp &nbsp <i class="small material-icons"> add_circle</i> 식당 등록 </h4>
<br><br>


<form action = 'Register Restaurant.php' method = 'post'>
    &nbsp &nbsp &nbsp 1. 식당 이름 <input type = "text" name = "restaurant_name"> <br> <br>
    &nbsp &nbsp &nbsp 2. 식당 소개 <input type = "text" name = "restaurant_description"> <br> <br>
    &nbsp &nbsp &nbsp 3. 식당 전화번호 <input placeholder = "&nbsp &nbsp &nbsp &nbsp 입력 예시: 02-123-4567" type = "text" name = "restaurant_phone"> <br> <br>
    &nbsp &nbsp &nbsp 4. 식당 위치 (도로명 주소) <input type = "text" name = "restaurant_location"> <br> <br>
    &nbsp &nbsp &nbsp 5. 식당 영업시간 (24시 기준) <input placeholder = "&nbsp &nbsp &nbsp &nbsp 입력 예시: 7:00 - 22:00" type = "text" name = "restaurant_opening"> <br> <br>
    &nbsp &nbsp &nbsp 6. 판매 메뉴 및 가격
    <div class = "row">
        <div class = "input-field col s3">
            <select class="browser-default" name = "foodtype">
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
        <div class = "input-field col s3">
            <input placeholder = "메뉴명" type = "text" name = "menu_name">
        </div>
        <div class = "input-field col s3">
            <input placeholder = "메뉴 가격" type = "number" name = "menu_price">
        </div>
    </div>

    &nbsp &nbsp &nbsp <input type = "submit">
</form>



<?php
    //echo $_POST["restaurant_name"];
    //echo $_POST["restaurant_description"];
    //echo $_POST["restaurant_phone"];
    //echo $_POST["restaurant_location"];
    //echo $_POST["restaurant_opening"];
    echo $_POST["menu_price"];
?>

</body>
</html>