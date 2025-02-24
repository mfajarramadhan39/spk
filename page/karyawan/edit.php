<?php 
// Mendapatkan id dari parameter GET dan melakukan sanitasi input
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mendapatkan data karyawan berdasarkan NIP
$sql = "SELECT * FROM karyawan WHERE NIP = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($result);

// Cek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil data dari form dengan sanitasi
    $nip = $_POST['NIP'];
    $nama_karyawan = $_POST['karyawan'];
    $jk = $_POST['JK'];
    $jabatan = $_POST['jabatan'];

    // Query untuk update data karyawan
    $sql = "UPDATE karyawan SET NIP = ?, nama_karyawan = ?, JK = ?, Jabatan = ? WHERE NIP = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nip, $nama_karyawan, $jk, $jabatan, $id);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo "<script>alert('Data berhasil diubah!');window.location.href='index.php?p=karyawan&ta=$ta'</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Karyawan</h3>
            </div>

            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="NIP">NIP</label>
                        <input type="text" class="form-control input-lg" id="NIP" placeholder="Masukan NIP" name="NIP" value="<?php echo htmlspecialchars($data['NIP']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control input-lg" id="karyawan" placeholder="Masukan Nama Karyawan" name="karyawan" value="<?php echo htmlspecialchars($data['nama_karyawan']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="JK">Jenis Kelamin</label>
                        <select class="form-control custom-select input-lg" name="JK" required>
                            <option disabled selected>-- Masukan Gender --</option>
                            <option value="Pria" <?php echo $data['JK'] == "Pria" ? "selected" : ""; ?>>Pria</option>
                            <option value="Wanita" <?php echo $data['JK'] == "Wanita" ? "selected" : ""; ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control input-lg" name="jabatan" required>
                            <option disabled selected>-- Pilih Jabatan --</option>
                            <?php 
                            $jabat = mysqli_query($con, "SELECT * FROM jabatan ORDER BY nama_jabatan");
                            while ($jab = mysqli_fetch_array($jabat)) {
                                echo "<option value='{$jab['id']}' " . ($data['Jabatan'] == $jab['id'] ? "selected" : "") . ">{$jab['nama_jabatan']}</option>";
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
