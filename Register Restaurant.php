<?php
    include 'includes/head.php';
    include 'includes/header.php';
?>

<style type = "text/css">
    h4 {color: #004d40;}
    form {font-size: 1.2rem; color: black;}
</style>

<h4> &nbsp &nbsp 식당 등록 </h4>
<br>

<form action = 'Register Restaurant.php' method = 'post'>

    &nbsp &nbsp &nbsp 1. 식당 이름 <input type = "text" name = "restaurant_name">
    &nbsp &nbsp &nbsp 2. 식당 소개 <input type = "text" name = "restaurant_description">
    &nbsp &nbsp &nbsp 3. 식당 번호 &nbsp >> 입력 예시: 02-123-4567 <input type = "text" name = "restaurant_phone">
    &nbsp &nbsp &nbsp 4. 식당 위치 (도로명 주소) <input type = "text" name = "restaurant_location">
    &nbsp &nbsp &nbsp 5. 식당 영업시간 (24h 기준) &nbsp >> 입력 예시: 7:00 - 22:00 <input type = "text" name = "restaurant_opening">
    &nbsp &nbsp &nbsp 6. 판매 메뉴 및 가격 &nbsp <textarea name="Text1" cols="40" rows="10"> 음식명과 가격을 띄어쓰기로 구분해주세요 >> 입력 예시: 김밥 3000 </textarea>
    <br> <br>
    &nbsp &nbsp &nbsp <input type = "submit">
</form>

<?php
    echo $_POST["restaurant_name"];
    echo $_POST["restaurant_description"];
    echo $_POST["restaurant_phone"];
    echo $_POST["restaurant_location"];
    echo $_POST["restaurant_opening"];
    echo $_POST["menu_price"];

?>





</body>
</html>