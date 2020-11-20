<?php
    include 'includes/head.php';
    include 'includes/header.php';
?>

<style type = "text/css">
    h4 {color: #004d40;}
    subtitle {font-size: 1.2rem; color: #004d40;}
    black {font-size: 1.1rem; color: #000000;}
    r {color: #ff0000;}
</style>

<script>      
    function menuAdd() {
        var menuInfo = document.createElement('menuInfo');
        menuInfo.innerHTML = document.getElementById('input_formset').innerHTML;
        document.getElementById('range').appendChild(menuInfo);
        var total = menuInfo.childElementCount();
    }
</script>

<?php
    // Database integration
    require 'includes/database.php';
    $rest_id = $_GET['id'];
    // Take restaurant information from database
    $sql = "SELECT * from restaurant where restaurant_id = '".$rest_id."'";
    $sql = $conn -> query($sql);
    $restaurant = $sql->fetch_array();
?>

<h4>&nbsp &nbsp <i class="small material-icons">create</i> 식당 정보 수정</h4>
<br>
&nbsp &nbsp &nbsp &nbsp &nbsp <a href = "Delete Restaurant.php?id=<?=$rest_id?>" class="waves-effect waves-light btn">식당 정보 삭제</a>
<br><br><br>

<form action = "Update Restaurant.php?id=<?=$rest_id?>" method = "post">
    <subtitle>&nbsp &nbsp &nbsp (1) 식당명 </subtitle> <br> 
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        <input type = "text" name = "restaurant_name" value = "<?php echo $restaurant["restaurant_name"];?>"required/></black>
        </div> <br>
    <subtitle>&nbsp &nbsp &nbsp (2) 소개 </subtitle> <br> 
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        <input type = "text" name = "restaurant_description" value = "<?php echo $restaurant["restaurant_description"];?>" required/></black>
        </div> <br>
    <subtitle>&nbsp &nbsp &nbsp (3) 전화번호 </subtitle> <br> 
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        <input type = "text" name = "restaurant_phone" value = "<?php echo $restaurant["restaurant_phone"];?>"required/></black>
        </div> <br>
    <subtitle>&nbsp &nbsp &nbsp (4) 위치 </subtitle> <br> 
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        <input type = "text" name = "restaurant_location" value = "<?php echo $restaurant["restaurant_location"];?>"required/></black> 
        </div><br>
    <subtitle>&nbsp &nbsp &nbsp (5) 영업시간 </subtitle> <br>
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        <input type = "text" name = "restaurant_opening" value = "<?php echo $restaurant["restaurant_opening"];?>"required/></black> 
        </div><br>
    <subtitle>&nbsp &nbsp &nbsp (6) 휴무일 </subtitle> <br>
        <div class="card-panel grey lighten-5">
        <black>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
        <input type = "text" name = "restaurant_close" value = "<?php echo $restaurant["restaurant_close"];?>"required/></black>
        </div><br>
    <subtitle>&nbsp &nbsp &nbsp (7) 메뉴 및 가격 &nbsp </subtitle> 
    <a class = "btn-floating btn-small waves-effect waves-light red" onclick = "menuAdd()"><i class="material-icons">add</i></a>
     <br>
        <div class = 'container'>
        <div id = "restaurant_list">
        <table class="highlight">
            <thead>
            <tr>
                <th>메뉴 구분</th>
                <th>메뉴 이름</th>
                <th>메뉴 가격</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sql_menu = "SELECT foodtype_id, menu.menu_id, menu_name, menu_price from menu, foodtype where restaurant_id = '".$rest_id."' and menu.menu_id = foodtype.menu_id";
                $sql_menu = $conn -> query($sql_menu);
                $k = 0;
                while($menu = $sql_menu->fetch_array()) {
                    $delete_menu = '<form action = "Update Restaurant.php?id=<?=$rest_id?>" method = "POST">
                                <input type = "hidden" name = "delete_menu" value="'.$menu['menu_id'].'">
                                <input type = "submit" value = "삭제">
                                </form>';
                    $menu_id[$k] = $menu['menu_id'];
                    $k += 1;
            ?>
            <tr>
                <td> <select class="browser-default" name = "foodtype_id[]">
                        <option value="<?php $menu['foodtype_id'];?>"><?php echo $menu['foodtype_id'];?></option>
                        <option value="한식">한식</option>
                        <option value="분식">분식</option>
                        <option value="일식">일식</option>
                        <option value="중식">중식</option>
                        <option value="양식">양식</option>
                        <option value="아시안">아시안</option>
                        <option value="카페">카페</option>
                    </select></td>
                <td> <input type = "text" name = "menu_name[]" value = "<?php echo $menu['menu_name'];?>"> </td>
                <td> <input type = "number" name = "menu_price[]" value = "<?php echo $menu['menu_price'];?>"></td>
            </tr>
        <?php }; ?>
        </tbody>
        </table> <br> </div>
        </div>

        <div id = "input_formset" style =  "display: none">
        <div class = "container">
        <div class = "row">
            <div class = "input-field col s3">
                <select class="browser-default" name = "add_foodtype[]">
                    <option value="none">메뉴 분류를 선택해주세요</option>
                    <option value="한식">한식</option>
                    <option value="분식">분식</option>
                    <option value="일식">일식</option>
                    <option value="중식">중식</option>
                    <option value="양식">양식</option>
                    <option value="아시안">아시안</option>
                    <option value="카페">카페</option>
                </select>
            </div>
            <div class = "input-field col s3">
                <input placeholder = "메뉴명" type = "text" name = "add_menu_name[]">
            </div>
            <div class = "input-field col s3">
                <input placeholder = "메뉴가격" type = "number" name = "add_menu_price[]">
            </div>
        </div></div>
        </div>
    <div id = "range"></div>
    <br>
    &nbsp &nbsp &nbsp <input type = "submit" name = "submit" value = '수정하기'>
</form>
    
<?php
    // when the '수정하기' button(submit) is pressed, revised information is received in variables through '$_post'
    if (isset($_POST['submit'])) {
        // add database connection
        require 'includes/database.php';
        // update data in restaurant table
        $restaurant_name = trim($_POST['restaurant_name']);  // trim: remove spaces from both sides
        $restaurant_description = trim($_POST['restaurant_description']);
        $restaurant_phone = trim($_POST['restaurant_phone']);
        $restaurant_location = trim($_POST['restaurant_location']);
        $restaurant_opening = trim($_POST['restaurant_opening']);
        $restaurant_close = trim($_POST['restaurant_close']);
        $sql_rest_update = "UPDATE restaurant 
                            set restaurant_name = '".$restaurant_name."',
                                restaurant_description = '".$restaurant_description."',
                                restaurant_phone = '".$restaurant_phone."',
                                restaurant_location = '".$restaurant_location."',
                                restaurant_opening = '".$restaurant_opening."',
                                restaurant_close = '".$restaurant_close."'
                            where restaurant_id = '".$rest_id."'";
        $conn -> query($sql_rest_update);

        // update data in foodtype, menu table
        $foodtype_id = $_POST['foodtype_id'];
        $menu_name = $_POST['menu_name'];
        $menu_price = $_POST['menu_price'];

        for($i=0; $i<count($menu_id); $i++) {
            $sql_menu_update = "UPDATE menu 
                                set menu_name = '".$menu_name[$i]."',
                                    menu_price = '".$menu_price[$i]."'
                                where restaurant_id = '".$rest_id."' and menu_id = '".$menu_id[$i]."'";
            $conn -> query($sql_menu_update);
            $sql_foodtype_update = "UPDATE foodtype 
                                    set foodtype_id = '".$foodtype_id[$i]."',
                                    where menu_id = '".$menu_id[$i]."'";
            $conn -> query($sql_foodtype_update); 
        };

        // insert new data to foodtype, menu table
        $add_foodtype = $_POST['add_foodtype'];
        $add_menu_name = $_POST['add_menu_name'];
        $add_menu_price = $_POST['add_menu_price'];

        if (count($add_foodtype) > 1) {
            $sql = "INSERT INTO menu (restaurant_id, menu_name, menu_price) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            // DYNAMIC QUERY: using for loop to insert records
            for($i=1; $i<count($add_menu_name); $i++) {
                $stmt->bind_param("isi", $rest_id, $add_menu_name[$i], $add_menu_price[$i]);
                $stmt->execute();
                $last_menu_id = $conn->insert_id;
                $sql_foodtype = "INSERT INTO foodtype (foodtype_id, menu_id) VALUES (?, ?)";
                $stmt_foodtype = $conn->prepare($sql_foodtype);
                $stmt_foodtype->bind_param("si", $add_foodtype[$i], $last_menu_id);
                $stmt_foodtype->execute();       
            };
            $stmt->close();
            $stmt_foodtype->close();
            $conn->close();
        };
        // if new records created successfully, display completion message
    echo "<br>";
    echo "&nbsp &nbsp &nbsp <black> 식당 정보가 성공적으로 수정되었습니다! </black>";
    };
?>

</body>
</html>