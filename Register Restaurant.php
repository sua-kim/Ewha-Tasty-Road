<?php
    //require_once 'includes/database.php';
    include 'includes/head.php';
    include 'includes/header.php';
    
?>

<style type = "text/css">
    h4 {color: #004d40;}
    form {font-size: 1.1rem; color: black;}
    r {color: #ff0000;}
    black {font-size: 1.3rem; color: #004d40;}
</style>

<h4> &nbsp &nbsp <i class="small material-icons"> create </i> 식당 등록 </h4>
<r> &nbsp &nbsp &nbsp &nbsp &nbsp * 필수 입력 항목 </r>
<br><br>

<script>      
    function menuAdd() {
        var menuInfo = document.createElement('menuInfo');
        menuInfo.innerHTML = document.getElementById('input_formset').innerHTML;
        document.getElementById('range').appendChild(menuInfo);
        var total = menuInfo.childElementCount();
    }
    //function menuDelete(createdForm) {
    //  document.getElementById('range').removeChild(createdForm.parentNode.parentNode);
    //}
</script>

<form action = 'Register Restaurant.php' method = 'post'>
    &nbsp &nbsp &nbsp 1. 식당 이름 <r>*</r> <input type = "text" name = "restaurant_name" required/> <br> <br>
    &nbsp &nbsp &nbsp 2. 식당 소개 <r>*</r> <input type = "text" name = "restaurant_description" required/> <br> <br>
    &nbsp &nbsp &nbsp 3. 식당 전화번호 <r>*</r> <input placeholder = "&nbsp &nbsp &nbsp &nbsp 입력 예시: 02-123-4567" type = "text" name = "restaurant_phone" required/> <br> <br>
    &nbsp &nbsp &nbsp 4. 식당 위치 (도로명 주소) <r>*</r> <input type = "text" name = "restaurant_location" required/> <br> <br>
    &nbsp &nbsp &nbsp 5. 식당 영업시간 (24시 기준) <r>*</r> <input placeholder = "&nbsp &nbsp &nbsp &nbsp 입력 예시: 월수금: 7:00 - 22:00 / 화목: 7:00 - 21:00" type = "text" name = "restaurant_opening" required/> <br> <br>
    &nbsp &nbsp &nbsp 6. 식당 휴무일 <r>*</r> <input placeholder = "&nbsp &nbsp &nbsp &nbsp 없을 경우 '없음'이라고 입력" type = "text" name = "restaurant_close" required/> <br> <br>
    &nbsp &nbsp &nbsp 7. 식당 메뉴 및 가격 &nbsp <r>*</r> <input type = "button" onclick = "menuAdd()" value = "메뉴 추가">
    <div id = "input_formset" style =  "display: none">
        <div class = "row">
            <div class = "input-field col s3">
                <select class="browser-default" name = "foodtype[]">
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
                <input placeholder = "메뉴명" type = "text" name = "menu_name[]">
            </div>
            <div class = "input-field col s3">
                <input placeholder = "메뉴가격" type = "number" name = "menu_price[]">
            </div>
            <!-- <input type = "button" onclick = "menuDelete(this)" value = "메뉴 삭제"> -->
        </div>
    </div>
    <div id = "range"></div>
    <br>
    &nbsp &nbsp &nbsp <input type = "submit" name = "submit" value = '등록하기'>
</form>

<?php
    // when the '등록하기' button(submit) is pressed, information is received in variables through '$_post'
    if (isset($_POST['submit'])) {
        // add database connection
        require'database.php';
 
        $restaurant_name = trim($_POST['restaurant_name']);  // trim: remove spaces from both sides
        $restaurant_description = trim($_POST['restaurant_description']);
        $restaurant_phone = trim($_POST['restaurant_phone']);
        $restaurant_location = trim($_POST['restaurant_location']);
        $restaurant_opening = trim($_POST['restaurant_opening']);
        $restaurant_close = trim($_POST['restaurant_close']);
        $foodtype = $_POST['foodtype'];
        $menu_name = $_POST['menu_name'];
        $menu_price = $_POST['menu_price'];

        if (empty($restaurant_name)||empty($restaurant_description)||empty($restaurant_phone)||empty($restaurant_location)||empty($restaurant_opening)||empty($restaurant_close)) {
            header("Location: ../register restaurant.php?error=emptyfileds&restaurant_name=".$restaurant_name);
            exit();
        } else {
            // insert data to restaurant table
            $sql = "INSERT INTO restaurant (restaurant_name, restaurant_description, restaurant_phone, restaurant_location, restaurant_opening, restaurant_close) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $restaurant_name, $restaurant_description, $restaurant_phone, $restaurant_location, $restaurant_opening, $restaurant_close);
            $stmt->execute();

            $last_restaurant_id = $conn->insert_id;
            $sql = "INSERT INTO menu (restaurant_id, menu_name, menu_price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            for($i=1; $i<count($menu_name); $i++) {
                $stmt->bind_param("isi", $last_restaurant_id, $menu_name[$i], $menu_price[$i]);
                $stmt->execute();

                $last_menu_id = $conn->insert_id;
                $sql_foodtype = "INSERT INTO foodtype (foodtype_id, menu_id) VALUES (?, ?)";
                $stmt_foodtype = $conn->prepare($sql_foodtype);
                $stmt_foodtype->bind_param("si", $foodtype[$i], $last_menu_id);
                $stmt_foodtype->execute();
                
            };
            $stmt->close();
            $stmt_foodtype->close();
            $conn->close();
        // new records created succesfully
        echo "<br>";
        echo "&nbsp &nbsp &nbsp <black> 식당이 성공적으로 등록되었습니다! </black>";
        };   
    };
?>

</body>
</html>
