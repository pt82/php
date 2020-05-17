<div class="row">

    <div class="col-sm-12 col-md-6 col-lg-6 left ">
        <!-- Section A - countries -->
<p>
  <button class="btn btn bigin bg-success" type="button" data-toggle="collapse" data-target="#collapseCountry" aria-expanded="false" aria-controls="collapseExample">
    Страны
  </button>
</p>


        <?php
        $link = connect();
        $sel = 'SELECT * FROM countries ORDER BY(id)'; // запрос на получ. всех данных
        $res = mysqli_query($link, $sel);
//        var_dump($res);
echo '<div class="collapse" id="collapseCountry">';
echo '<div class="row">';
echo '<div class="col-sm-12 col-md-8 col-lg-8">';
echo '<form action="index.php?page=4" method="post" class="input-group" id="formcountry">';
     
// добавление стран в таблицу countries
echo '<input class="bigin form-control mb-2 mr-sm-2" type="text" name="country" placeholder="country">';
echo '</div>'; 
echo '<div class="col-sm-12 col-md-4 col-lg-4">';
echo '<input  type="submit" name="addcountry" value="Добавить" class="btn btnfunc btn-sm btn-info">';
// кнопка удаления страны
echo '<input type="submit" name="delcountry" value="Удалить" class="btn btnfunc btn-sm btn-warning ">';
echo '</div>'; 
echo '</div>';      
           // вывод стран в таблицу
           echo "<form>";
          
           
          
           echo '<div class = "my-custom-scrollbar scroll" >';
           
           echo '<table id="tb" class="table table-hover ">';
           echo '<th class="fix__th id__th">Код страны</th>';
           echo '<th class="fix__th name__th">Наименование страны</th>';
           echo '<th class="fix__th"></th>';
           echo '<th class="fix__th"></th>';
           echo '<th class="fix__th"></th>';

           while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
               echo '<tr>';
                   echo '<td>'.$row[0].'</td>'; // id страны
                   echo '<td>'.$row[1].'</td>'; // название страны
                   echo '<td><input type="checkbox" name="cb'.$row[0].'"></td>';
                   echo '<form method="post" action="index.php?page=4">';
                   echo '<td><input type="hidden" name="delid" value="'.$row[0].'"></td>';
                   echo '<td><button class = "btn btn-danger btn-sm" type="submit" name="delone" value="del'.$row[0].'"><i class="fa fa-trash-alt"></i></button></td>';
                   echo "</form>"; 

                  echo '</tr>';
           }
          
           echo '</table>';
           echo '</div>';
           echo "</form>";
           echo "</form>";
           echo '</div>';
        
                 
        mysqli_free_result($res); // освобождает память, занятую запросом
           
        if (isset($_POST['delone'])) {
            $id=intval($_POST['delid']);
            $del = 'DELETE FROM countries WHERE id='.$id;
            mysqli_query($link, $del);
            echo '<script>window.location=document.URL</script>';
    }

        // обработчик для добавления страны
        if(isset($_POST['addcountry'])) {
            $country = trim(htmlspecialchars($_POST['country']));
            if($country=="") exit;
            $ins = "INSERT INTO countries(country) VALUES('$country')";
            mysqli_query($link, $ins);
            echo '<script>window.location=document.URL</script>';
        }
  
      
        // обработчик для удаления страны
        if(isset($_POST['delcountry'])) {
           
            // перебираем массив $_POST
            foreach($_POST as $k => $v) {
                    if(substr($k, 0, 2) === 'cb') {
                    $idc = substr($k, 2); // обрезаем строку, получая число из cb1, cb2 ...
                    $del = 'DELETE FROM countries WHERE id='.$idc;
                    mysqli_query($link, $del);
                }
            }
           echo '<script>window.location=document.URL</script>';
        }
        ?>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 right">
        <!-- Section B - cities -->
        <p>
  <button class="btn btn bigin bg-success" type="button" data-toggle="collapse" data-target="#collapseCity" aria-expanded="false" aria-controls="collapseExample">
    Города
  </button>
</p>
        <?php
        // выбираем все данные из таблицы стран
        $res = mysqli_query($link, 'SELECT * FROM countries');

         
        echo '<div class="collapse" id="collapseCity">';
        echo '<div class="row">';
        echo '<div class="col-sm-12 col-md-8 col-lg-8 ">'; 
        echo '<form action="index.php?page=4" method="post" class="input-group" id="formcity">';
        
        // выпадающий список существующих стран
     
        echo '<select class="bigin form-control mb-2 mr-sm-2" name="countryname">';
        // перебираем страны
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo '</select>';
        
        echo '<input type="text" class="bigin form-control mb-2 mr-sm-2" name="city" placeholder="City">';
        echo '</div>';
        echo '<div class="col-sm-12 col-md-4 col-lg-4">';
        echo '<input type="submit" name="addcity" value="Добавить" class="btn btnfunc btn-sm btn-info">';
        echo '<input type="submit" name="delcity" value="Удалить" class="btn btnfunc btn-sm btn-warning">';
        echo '</div>';
        echo '</div>';
        echo '<form>';
        $res = mysqli_query($link, 'SELECT * FROM cities');
        echo '<div class="my-custom-scrollbar scroll">';
        echo '<table class="table table-hover   ">';
        echo '<th class="fix__th id__th">Код города</th>';
        echo '<th class="fix__th name__th">Наименование города</th>';
        echo '<th class="fix__th"></th>';
        echo '<th class="fix__th"></th>';
        echo '<th class="fix__th"></th>';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
                echo '<td>'.$row[0].'</td>'; // id страны
                echo '<td>'.$row[1].'</td>'; // название страны
                echo '<td><input type="checkbox" name="cbc'.$row[0].'"></td>';
                echo '<form method="post" action="index.php?page=4">';
                echo '<td><input type="hidden" name="delid" value="'.$row[0].'"></td>';
                echo '<td><button class = "btn btn-danger btn-sm" type="submit" name="delone" value="del'.$row[0].'"><i class="fa fa-trash-alt"></i></button></td>';
                echo "</form>"; 
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</form>';
        echo '</form>';
        
           // обработчик добавления города
        if(isset($_POST['addcity'])) {
            $city = trim(htmlspecialchars($_POST['city']));
            if($city == "") exit;
            $countryid = $_POST['countryname']; // здесь будет записано значение из селекта, в зависимости от выбранного option и его value. Пример: в select выбрана страна Argentina, то в $_POST['countryname'] будет номер, допустим 9
            $ins = "INSERT INTO cities(city, countryid) VALUES('$city', '$countryid')";
            mysqli_query($link, $ins);
            
            if(mysqli_error($link)) {
                echo "Error text: " . mysqli_error($link);
                exit;
            }
            
            echo '<script>window.location=document.URL</script>';
        }

        if (isset($_POST['delone'])) {
            $id=intval($_POST['delid']);
            $del = 'DELETE FROM cities WHERE id='.$id;
            mysqli_query($link, $del);
            echo '<script>window.location=document.URL</script>';
    }

         // обработчик для удаления города
         if(isset($_POST['delcity'])) {
           
            // перебираем массив $_POST
            foreach($_POST as $k => $v) {
                echo $k;
                if(substr($k, 0, 3) === 'cbc') {
                    $idc = substr($k, 3); // обрезаем строку, получая число из cb1, cb2 ...
                    $del = 'DELETE FROM cities WHERE id='.$idc;
                    
                    mysqli_query($link, $del);
                }
            }
           echo '<script>window.location=document.URL</script>';
        }
        ?>
    </div>
</div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 left">
        <!-- Section C - hotels -->
        <p>
  <button class="btn btn bigin bg-success" type="button" data-toggle="collapse" data-target="#collapseHotel" aria-expanded="false" aria-controls="collapseExample">
    Отели
  </button>
</p>
        <?php
        echo '<form action="index.php?page=4" method="post" class="form-inline" id="formhotel">';
        
        $sel = 'SELECT ci.id, ci.city, co.country, co.id FROM countries co, cities ci WHERE ci.countryid=co.id'; // через WHERE реализуем связь 1к1, т.е. каждый город будет соответствовать только одной стране.
        $res = mysqli_query($link, $sel); // ci.id[0], ci.city[1], co.country[2], co.id[3]
        
        $coid_array = array(); // создаем ассоциативный массив
        echo '<div class="collapse" id="collapseHotel">';
        echo '<div class="row">';
        echo '<div class="col-sm-12 col-md-8 col-lg-8">'; 
        echo '<select name="hcity"  class="form-control  mb-2 mr-sm-2 custom-select">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1] : $row[2]</option>";
            $coid_array[$row[0]] = $row[3]; // т.е. присвоить co.id
        }
        echo '</select>';
        
        echo '<input type="text" name="hotel" placeholder="hotel" class="form-control bigin mb-2 mr-sm-2">';
        echo '<input  class="form-control bigin mb-2 mr-sm-2 type="text" placeholder="stars" id="stars" name="stars" min="1" max="5">';
        echo '<input  class="form-control mb-2 mr-sm-2 type="text" name="cost" placeholder="cost">';
        echo '<br><textarea class="form-control mb-2 mr-sm-2 type="text" name="info" placeholder="Description hotel"></textarea>';
        echo '</div>';
        
        echo '<div class="col-sm-12 col-md-4 col-lg-4">';
        echo '<input type="submit" name="addhotel" value="Добавить" class="btn btnfunc btn-sm btn-info">';
        echo '<input type="submit" name="delhotel" value="Удалить" class="btn btnfunc btn-sm btn-warning">';
        echo '</div>';
        echo '</div>';
        echo '<form>';
        $res = mysqli_query($link, 'SELECT * FROM hotels');
        echo '<div class="my-custom-scrollbar scroll">';
        echo '<table class="table table-hover">';
        echo '<th class="fix__th id__th">Код отеля</th>';
        echo '<th class="fix__th name__th">Наименование отеля</th>';
        echo '<th class="fix__th"></th>';
        echo '<th class="fix__th"></th>';
        echo '<th class="fix__th"></th>';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo '<tr>';
                echo '<td>'.$row[0].'</td>'; // id отеля
                echo '<td>'.$row[1].'</td>'; // название отеля
                echo '<td><input type="checkbox" name="cbh'.$row[0].'"></td>';
                echo '<form method="post" action="index.php?page=4">';
                echo '<td><input type="hidden" name="delid" value="'.$row[0].'"></td>';
                echo '<td><button class = "btn btn-danger btn-sm" type="submit" name="delone" value="del'.$row[0].'"><i class="fa fa-trash-alt"></i></button></td>';
                echo "</form>"; 
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</form>';
       echo '</form>';
       echo '</div>';
        
        // добавление отеля
        if(isset($_POST['addhotel'])) {
            $hotel = trim(htmlspecialchars($_POST['hotel']));
            $cost = intval(trim(htmlspecialchars($_POST['cost']))); // intval() - преобразует текст в число
            $stars = intval($_POST['stars']);
            $info = trim(htmlspecialchars($_POST['info']));
            if($hotel == "" || $cost == "" || $info == "") exit;
            $cityid = $_POST['hcity']; // берем value из выпадающего списка, т.е. номер города
            $countryid = $coid_array[$cityid]; // берем из массива $coid_array индекс по номеру города (ci.id) и заносим в переменную
                        
            $ins = "INSERT INTO hotels(hotel, cityid, countryid, stars, cost, info) VALUES('$hotel', '$cityid', '$countryid', '$stars', '$cost', '$info')";
            mysqli_query($link, $ins);
            
            if(mysqli_error($link)) {
                echo "Error text: " . mysqli_error($link);
                exit;
            }
            echo '<script>window.location=document.URL</script>';
        }

        if (isset($_POST['delone'])) {
            $id=intval($_POST['delid']);
            $del = 'DELETE FROM hotels WHERE id='.$id;
            mysqli_query($link, $del);
            echo '<script>window.location=document.URL</script>';
    }
    if(isset($_POST['delhotel'])) {
           
        // перебираем массив $_POST
        foreach($_POST as $k => $v) {
            echo $k;
            if(substr($k, 0, 3) === 'cbh') {
                $idc = substr($k, 3); // обрезаем строку, получая число из cb1, cb2 ...
                $del = 'DELETE FROM hotels WHERE id='.$idc;
                
                mysqli_query($link, $del);
            }
        }
       echo '<script>window.location=document.URL</script>';
    }
        
        ?>
        
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 right">
        <!-- Section D - images -->
        <p>
        <button class="btn btn bigin bg-success" type="button" data-toggle="collapse" data-target="#collapsegallary">
             Галлерея отелей
        </button>
        </p>
        <?php
       
       


        echo '<form  action="index.php?page=4" method="post" enctype="multipart/form-data" class="input-group">';
        $sel = 'SELECT ho.id, co.country, ci.city, ho.hotel FROM countries co, cities ci, hotels ho WHERE ho.countryid=co.id AND ho.cityid=ci.id';
        $res = mysqli_query($link, $sel);

        


        echo '<div class="collapse in" id="collapsegallary">';
        echo '<div class="row">';

        echo '<div class="col-sm-12 col-md-8 col-lg-8">'; 
        echo '<select name="hotelid"  class="form-control  mb-2 mr-sm-2 custom-select">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1]|$row[2]|$row[3]</option>";
        }
        echo '</select>';
       mysqli_free_result($res);
        echo '<input type="file" name="file[]" class="form-control mb-2 mr-sm-2 type="text" multiple accept="image/*" id="upload">';
        echo '</div>';

        echo '<div class="col-sm-12 col-md-4 col-lg-4">';
        echo '<input type="submit" name="addimage" value="Добавить" class="btn btnfunc btn-sm btn-info">';
        echo '<input type="submit" name="viewimage" value="Показать таблицу" class="btn btn bigin bg-success" type="button" data-toggle="collapse" >';
       // echo '<button type="submit" name="viewimage" value="Показать таблицу" >asdasd</button>';
        echo '</div>';

      

        echo '</div>';


    

        echo '</div>';
      
        echo ' <div id="preview"></div>';
             echo '</form>';

             echo '<div class="collapse" id="collapsegallarytable">';
             if(isset($_POST['viewimage'])){
                 echo $_POST['hotelid'];
                 echo '<div class="my-custom-scrollbar scroll">';
                 echo '<table class="table table-hover   ">';
                 echo '<th class="fix__th name__th">Наименование отеля</th>';
                 echo '<th class="fix__th name__th">Расположение фото</th><tr>';
               
                $sel = 'SELECT imagepath im, hotel ho FROM images im, hotels ho WHERE im.hotelid='.$_POST['hotelid'].'&& ho.id='.$_POST['hotelid'];
                 $res = mysqli_query($link,$sel);
                 while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                     echo '<td>'.$row[1].'</td>';
                     echo '<td>'.$row[0].'</td><tr>';
              }
              mysqli_free_result($res);
            echo '</div>';
             }
             echo '</div>';
       
  

         
       
        if(isset($_POST['addimage'])){
          
            //пребираем все загруженные картинки
            foreach($_FILES['file']['name'] as $k=>$v) {
              
                //проверяем произошла ли ошибка при загрузки какого-нибудь множества файлов
                if($_FILES['file']['error'][$k]!=0){
                   echo '<script>alert("Upload file error:'.$_FILES['file']['error'][$k] .':'. $v.')</script>';
                    continue;

                }
                if(move_uploaded_file($_FILES['file']['tmp_name'][$k],'images/'.$v)){
                   
                    $ins = 'INSERT INTO images(hotelid, imagepath) VALUES ('.$_POST['hotelid'].',"images/'.$v.'")';
                    mysqli_query($link, $ins);
                }
            }
        }
        ?>

      
    </div>
</div>


<?php




