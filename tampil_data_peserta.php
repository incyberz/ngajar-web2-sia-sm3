<?php
# ============================================================
# PROCESSORS
# ============================================================
if (isset($_POST['btn_delete'])) {
  $s = "DELETE FROM tb_peserta WHERE id=$_POST[btn_delete]";
  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  echo "<div class='alert alert-success'>Delete berhasil</div>";

  // redirect ke index.php
  echo "
<script>
  location.replace('index.php')
</script>
";
}

if (isset($_POST['btn_add'])) {

  echo '
<pre>';
  var_dump($_POST);
  echo '</pre>';

  $s = "INSERT INTO tb_peserta (
nama,
ip_address,
tipe_gadget
) VALUES (
'$_POST[nama]',
'$_POST[ip_address]',
$_POST[tipe_gadget]

)";

  $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

  echo "<div class='alert alert-success'>Add berhasil</div>";

  // redirect ke index.php
  echo "
<script>
  location.replace('index.php')
</script>
";
}




# ============================================================
# MAIN SELECT | TAMPIL DATA
# ============================================================
$s = "SELECT * FROM tb_peserta ";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

// looping
$tr = '';
$i = 0;
while ($d = mysqli_fetch_assoc($q)) {
  $i++;
  $tr .= "
<tr>
  <td>$i</td>
  <td>$d[nama]</td>
  <td>$d[ip_address]</td>
  <td>$d[tipe_gadget]</td>
  <td>$d[date_created]</td>
  <td>
    <button class='btn btn-sm btn-info'>Edit</button>

    <form method=post style='display:inline'>
      <button name=btn_delete value=$d[id] class='btn btn-sm btn-danger' onclick='return confirm(`Yakin mau hapus peserta ini?`)'>Delete</button>
    </form>
  </td>
</tr>
";
}


# ============================================================
# FORM TAMBAH DATA
# ============================================================
$tr .= "
<tr>
  <td colspan=100%>
    <form method=post>
      <input name=nama placeholder='Nama'>
      <input name=ip_address placeholder='IP Address'>
      <input name=tipe_gadget placeholder='Tipe Gadget'>
      <button name=btn_add>Add</button>
    </form>
  </td>
</tr>
";


# ============================================================
# FINAL UI
# ============================================================
echo "
  <table class='table table-striped table-hover'>
    <thead>
      <th>No</th>
      <th>Nama</th>
      <th>IP</th>
      <th>Gadget</th>
      <th>Date Created</th>
      <th>Aksi</th>
    </thead>
    $tr
  </table>
";
