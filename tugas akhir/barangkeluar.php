<?php
include 'koneksi.php';
if(isset($_GET['kode_barang'])){
    $read = mysqli_query($conn,"SELECT * FROM stok_barang WHERE kode_barang = '".$_GET['kode_barang']."'");
    $hasil1 = mysqli_fetch_array($read);
}
?>
<?php require("aksi.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Final</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="nav">
        <div class = "titlenav">
            Informasi Persediaan Stok Barang Toko
        </div>
    </div>
    <div class="wraper" id="title-id">
        <div class="atas">
            <div class="title">
                <div class="titleumum">Data Barang Toko</div>
                <a class="bar1" href="index.php">Stok Masuk</a>
                <a class="bar2" id="current" href="barangkeluar.php">Stok Keluar</a>
                <a class="bar3" href="detail.php">Detail Transaksi</a>
            </div>
        </div>
        <div class="sidebar-left">
            <div class="card">
                <form class="form" action="aksi.php" method="POST">
                <h3>Input Data Barang</h3>
                <?php
                    if(isset($_GET['error'])){ ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                    <input type="text" name="kode_barang" placeholder="Kode Barang" value="<?php echo @$hasil1['kode_barang']?>" class="input" required><br>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?php echo @$hasil1['nama_barang']?>" class="input"required><br>
                    <input type="number" name="stok_keluar" placeholder="Stok Barang Keluar" class="input" required><br>
                    
                    <input type="submit" name="tambah_barangkeluar" value="Simpan Data" class="btn">
                </form>
            </div>
        </div>   
        <div class="sidebar-right">
            <div style="padding:20px;">
                <div class="namatabel">Data Stok Barang Keluar</div>
                <table class="tabel2">
                    <tr>
                        <th width="10%">Tanggal</th>
                        <th width="10%">Kode Barang</th>
                        <th width="20%">Nama Barang</th>
                        <th width="10%">Stok Keluar</th>
                        <th width="30%">Aksi</th>
                    <?php
                    include 'koneksi.php';
                        $select = mysqli_query($conn, "SELECT * FROM stok_keluar");
                    if(mysqli_num_rows($select) > 0){
                        while($stok_keluar = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                        <td><?php echo $stok_keluar['Tanggal']; ?></td>
                        <td><?php echo $stok_keluar['kode_barang']; ?></td>
                        <td><?php echo $stok_keluar['nama_barang']; ?></td>
                        <td><?php echo $stok_keluar['stok_keluar']; ?></td>
                        <td>
                            <a class="aksi-green-keluar" href="editkeluar.php?kode_barang=<?php echo $stok_keluar['kode_barang']?>">Ubah</a>
                            <a class="aksi-red-keluar" href="aksi.php?hapus_data_keluar=<?php echo $stok_keluar['Tanggal']?>">Hapus</a>
                        </td>
                    </tr> 
                    <?php }}else{ ?>   
                    <tr>
                        <td colspan="6" ><center><img src="image/datainput.png" width="250px" height="170px"><center></td>
                    </tr>
                    <?php } ?>
                </table>
             </div>
        </div>
        <div style="clear:both"></div>
    </div>     
</body>                        
</html>