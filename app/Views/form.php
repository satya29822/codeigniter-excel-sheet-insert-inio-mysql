<?php


?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Excel import!</title>
  </head>
  <body>
    <div class="container">
      <h1>Excel import</h1>
    <form method="post" class="form-inline" action="form" enctype="multipart/form-data">
    <div class="form-group mb-2">
    
      <small><a href="<?php echo base_url("excel/format1.xlsx"); ?>">Download Format</a>||<a href="<?php echo base_url("siswa"); ?>">home</a></small>
    <input type="file" class="form-control-file" id="file" name="file">
    
    </div>
     <input type="submit" name="preview" value="preview" class="btn btn-success btn-sm">
   
    </form>

    <?php
  if(isset($_POST['preview'])){ 
    if(isset($upload_error)){
      echo "<div style='color: red;'>".$upload_error."</div>"; 
      die; 
    }

  
    echo "<form method='post' action='".base_url("siswa/import")."'>";

  
    echo "<div style='color: red;' id='kosong'>
    all data Required <span id=''></span> data not empty.
    </div>";

    echo "<table border='1' class='table table-hover' cellpadding='8'>
    <tr>
      <th colspan='5'>Preview Data</th>
    </tr>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Address</th>
    </tr>";

    $numrow = 1;
    $kosong = 0;

    foreach($data as $row){
 
      $no = $row['A']; 
      $name = $row['B']; 
      $gender = $row['C']; 
      $address = $row['D']; 

      
      if($nis == "" && $nama == "" && $jenis_kelamin == "" && $alamat == "")
        continue;

      if($numrow > 1){
        $nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; 
        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; 
        $jk_td = ( ! empty($jenis_kelamin))? "" : " style='background: #E07171;'"; 
        $alamat_td = ( ! empty($alamat))? "" : " style='background: #E07171;'";

        if($nis == "" or $nama == "" or $jenis_kelamin == "" or $alamat == ""){
          $kosong++; 
        }

        echo "<tr>";
        echo "<td".$nis_td.">".$nis."</td>";
        echo "<td".$nama_td.">".$nama."</td>";
        echo "<td".$jk_td.">".$jenis_kelamin."</td>";
        echo "<td".$alamat_td.">".$alamat."</td>";
        echo "</tr>";
      }

      $numrow++; 
    }

    echo "</table>";

    if($kosong > 0){
    ?>
      <script>
      $(document).ready(function(){
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');

        $("#kosong").show(); 
      });
      </script>
    <?php
    }else{ 
      echo "<hr>";
      echo "<button type='submit' class='btn btn-info' name='import'>process</button>";
      echo "&nbsp;";
      echo "<a href='".base_url("siswa")."' class='btn btn-dark'>Cancel</a>";
    }

    echo "</form>";
  }
  ?>

    </div>
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
  $(document).ready(function(){
    
    $("#kosong").hide();
  });
  </script>

  </body>
</html>