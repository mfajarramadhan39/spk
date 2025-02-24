<?php
error_reporting(0);

if (isset($_POST['simpan'])) {
  
    if (!$con) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

   
    $nip = mysqli_real_escape_string($con, $_POST['NIP']);
    $nama_karyawan = mysqli_real_escape_string($con, $_POST['karyawan']);
    $jenis_kelamin = mysqli_real_escape_string($con, $_POST['JK']);
    $jabatan = mysqli_real_escape_string($con, $_POST['jabatan']);

    $stmt = $con->prepare("INSERT INTO karyawan (NIP, nama, jenis_kelamin, jabatan, status) VALUES (?, ?, ?, ?, 'na')");
    $stmt->bind_param("ssss", $nip, $nama_karyawan, $jenis_kelamin, $jabatan);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!');window.location.href='index.php?p=karyawan'</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); 
}
?>
 ?>
 <style>
 .dm{
    margin:5px;
    padding: 10px;
     background: #E65E4C;
      color: white;
      border-left: #ED2B12 solid 5px;
      font-weight:35px;
   } 
   </style>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Karyawan</h3>
            </div>

            <?php if ($_GET['s'] == "dm") { echo "<div class='dm'>Password berbeda, coba lagi</div>"; } ?>

            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="NIP">NIP</label>
                        <input type="text" class="form-control input-lg" id="NIP" placeholder="Masukkan NIP" name="NIP" value="<?php echo isset($_GET['nip']) ? $_GET['nip'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control input-lg" id="karyawan" placeholder="Masukkan Nama Karyawan" name="karyawan" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="JK">Jenis Kelamin</label>
                        <select class="form-control custom-select input-lg" name="JK" required>
                            <option disabled selected>-- Pilih Gender --</option>
                            <option value="Pria" <?php echo isset($_GET['JK']) && $_GET['JK'] == "Pria" ? "selected" : ""; ?>>Pria</option>
                            <option value="Wanita" <?php echo isset($_GET['JK']) && $_GET['JK'] == "Wanita" ? "selected" : ""; ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control input-lg" name="jabatan" required>
                            <option disabled selected>-- Pilih Jabatan --</option>
                            <?php 
                            $jabat = mysqli_query($con, "SELECT * FROM jabatan ORDER BY nama_jabatan");
                            while ($jab = mysqli_fetch_array($jabat)) {
                                $id = $jab['id'];
                                $najab = $jab['nama_jabatan'];
                                echo "<option value='$id'>$najab</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


  <script>
  var check = function() {
  if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
  </script>
