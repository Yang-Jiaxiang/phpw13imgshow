<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form method="post" enctype="multipart/form-data" action="phpw11classwork.php">
  請匯入欲上傳的圖檔(限JPG,GIF或PNG檔):<input type="file" name="my_file"><br>
    <input type="submit" value="送出查詢">
  </form>

  <?php
    $imgName;
    # 檢查檔案是否上傳成功
    if ($_FILES['my_file']['error'] === UPLOAD_ERR_OK){
      if($_FILES['my_file']['type']!='image/jpeg'&&$_FILES['my_file']['type']!='image/png'&&$_FILES['my_file']['type']!='image/gif'){
        echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>檔案格式錯誤';
      }
      else{
        /*
        echo '檔案名稱: ' . $_FILES['my_file']['name'] . '<br/>';
        echo '檔案類型: ' . $_FILES['my_file']['type'] . '<br/>';
        echo '檔案大小: ' . ($_FILES['my_file']['size'] / 1024) . ' KB<br/>';
        echo '暫存名稱: ' . $_FILES['my_file']['tmp_name'] . '<br/>';
        */
        $imgName=$_FILES['my_file']['name'];
        $file_path = './082214213file';
        if(!file_exists($file_path)){
          mkdir($file_path);
          echo '建立資料夾成功';
        }else{
          echo '資料夾已存在';
          echo '<br>';
          $file = $_FILES['my_file']['tmp_name'];
          $dest = '082214213file/' . $_FILES['my_file']['name'];
          # 將檔案移至指定位置
          move_uploaded_file($file, $dest);
          $arr = getimagesize("082214213file/$imgName");
          if($arr[0]<='1000'){
            echo "<img src=\"/082214213file/$imgName\">";
          }
          else{
            echo "<img src=\"/082214213file/$imgName\" width='50%'>";
          }
          echo $arr[0];
        }
      }
    } else {
      echo '錯誤代碼：' .$_FILES['my_file']['error'] . '<br/>';
    }
    
  ?>
</body>
</html>
