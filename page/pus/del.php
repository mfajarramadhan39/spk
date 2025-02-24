<?php
        
        $sql = "DELETE FROM temp WHERE periode = '".$_GET['ta']."'";
        $query = mysqli_query($con, $sql);
      
        $sql = "DELETE FROM alternatif WHERE periode = '".$_GET['ta']."'";
        $query = mysqli_query($con, $sql);
        if ($query){
          $sql = "DELETE FROM nilai_alternatif WHERE periode = '".$_GET['ta']."'";
          $query = mysqli_query($con, $sql);
          
          if ($query){
              $back = "UPDATE karyawan set status='na' where periode = '".$_GET['ta']."'";
              mysqli_query($con, $back);
            echo "<script>alert('Data telah direset ulang');window.location.href='index.php?p=alternatif'</script>";
          } else {
            echo mysqli_error($con);
          }
        }
        else{
          echo mysqli_error($con);
      }

      
?>