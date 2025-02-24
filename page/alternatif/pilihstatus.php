<?php 

  if (isset($_POST['simpan'])) {

    echo "<script>window.location.href='index.php?p=alternatif&d=$_POST[status]'</script>";
  }

 ?>

<div class="row">
  
    <div class="col-md-8">
     
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pilih status karyawan</h3>
        <
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">status</label>
              <select name="status" class="form-control" required>
                <option disabled selected>-- Pilih status --</option>
                <option value="tetap">Tetap</option>
                <option value="honor">Honor</option>
                
              </select>
            </div>
          </div>
        
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Pilih</button>
          
          </div>
        </form>
      </div>
     


    <?php  
      $sql = "select * from alternatif";
      $query = mysqli_query($con, $sql);
      $data = mysqli_fetch_assoc($query);
      $row = mysqli_num_rows($query);

      if ($row > 0 && $data['lihat'] == '0') {
    ?>

    <a href="index.php?p=rank" class="btn btn-primary">Lihat Ranking</a>

    <?php 
      } else if($data['lihat'] == '1'){

        $sql = "TRUNCATE TABLE alternatif;";
        $query = mysqli_query($con, $sql);
        if ($query){
          $sql = "TRUNCATE TABLE nilai_alternatif;";
          $query = mysqli_query($con, $sql);
          if ($query){
            echo "Data telah direset ulang";
          } else {
            echo mysqli_error($con);
          }
        }
        else
          echo mysqli_error($con);
      }

    ?>

    </div>
  
    
  </div>