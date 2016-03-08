<link rel="stylesheet" type="text/css" href="http://localhost/jne/css/tambah_barangview.css">
<center><font face="Work Sans" size=48> Tambah Barang </font></center>
<div id="kotak">
<center>
<form method="POST">
	<input type="text" name="id" hidden="true" placeholder="ID Barang..." value="id" />
	<br><br><input type="text" name="nama" placeholder="Nama Barang..." value="" id="nama_brg"/>
	<br><br><input type="text" name="nama" placeholder="Nama Customer..." id="nama_cus"/>
		<br><br><input type="text" name="berat" placeholder="Berat Barang..." id="berat"/>
			<br><br><input type="text" name="jenis" placeholder="Jenis Barang..." id="jenis"/>
				<br><br><input type="text" name="tujuan" placeholder="Tempat Tujuan..." id="tujuan"/>
		</select>
		<br><br><a href="<?=base_url('');?>pegawai/home" class="submit btn-submit hvr-radial-out"></a>
	  <button class="hvr-radial-out button" type="submit" id="button">Tambah</button>
</form>
</center>
</div>