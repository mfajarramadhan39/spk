<?php 
  if (isset($_POST['simpan'])) {
    $nama=$_POST['NJ'];
    $JD=$_POST['JD'];
      $cekagy=mysqli_query($con,"SELECT * from jabatan where nama_jabatan like '".$nama."'");
      if (mysqli_num_rows($cekagy) > 0) {
        echo "<script>alert('Data ".$nama." Sudah Tersedia!');window.location.href='index.php?p=jabatan'</script>";
      }else{
        $input=mysqli_query($con,"INSERT INTO jabatan values (null, '$nama','$JD')");
        if ($input == TRUE) {
          echo "<script>alert('Data ".$nama." Berhasil Ditambahkan!');window.location.href='index.php?p=jabatan'</script>";
        }else{
          echo "<script>alert('Data ".$nama." Gagal dieksekusi!');window.location.href='index.php?p=jabatan&act=create'</script>";
        }
      }
  }

 ?>
<div class="row">
   
    <div class="col-md-8">
  
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form input jabatan</h3>
          
        </div>
      
        <form role="form" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jabatan</label>
              <input type="text" name="NJ" class="form-control input-lg">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Job Description</label>
              <textarea name="JD" placeholder="Masukan Job Description" class="form-control input-lg" id="exampleInputEmail1"></textarea>
            
              
            </div>
          </div>
          
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          </div>
        </form>
      </div>



    </div>

  </div>
