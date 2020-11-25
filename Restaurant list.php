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

<!-- link to 'Search Restaurant' page -->
<black>&nbsp &nbsp &nbsp &nbsp &#9889 원하는 곳을 빨리 찾고싶다면?</black>
<a href="Search Restaurant.php"> &nbsp &nbsp 식당 검색</a>
<br>

<!-- link to 'Register Restaurant' page -->
<black>&nbsp &nbsp &nbsp &nbsp &#129300 혹시 찾는 가게가 없으신가요?</black>
<a href="Register Restaurant.php"> &nbsp &nbsp 식당 등록</a>
<br><br>

<!-- display the list of restaurants with brief information-->
<div class = 'container'>
    <div id = "restaurant_list">
    <table class="highlight">
        <thead>
          <tr>
              <th>식당 이름</th>
              <th>식당 소개</th>
              <th>영업 시간</th>
          </tr>
        </thead>

        <?php
            // Database integration
            require 'includes/database.php';

            // Take restaurant list from database
            $sql = "SELECT restaurant_id, restaurant_name, restaurant_description, restaurant_opening FROM restaurant ORDER BY restaurant_id";
            $sql = $conn -> query($sql);
            while($restaurant = $sql->fetch_array()) {
                $short_description = $restaurant["restaurant_description"];
                if(strlen($short_description)>50) {
                    $short_description = str_replace($restaurant["restaurant_description"], mb_substr($restaurant["restaurant_description"], 0, 50, "utf-8"), $restaurant["restaurant_description"]);
                };
        ?>

        <tbody>
          <tr>
            <td><a href = "restaurant information.php?id=<?=$restaurant["restaurant_id"]?>"><?=$restaurant["restaurant_name"]?></a></td>
            <td> <?=$restaurant['restaurant_description']; ?> </td>
            <td> <?=$restaurant['restaurant_opening']; ?> </td>
          </tr>
        </tbody>
            <?php }; ?>
    </table>
    </div>
</div>

</body>
</html>