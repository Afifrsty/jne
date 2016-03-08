<link rel="stylesheet" type="text/css"href="http://localhost/jne/css/tambah_userview.css">
<center><font face="Work Sans" size=48> Tambah User </font></center>
<div id="kotak">
<center>
<form method="POST" action="http://localhost/jne/admin/tambah/add_user">
	<input type="text" name="id" hidden="true" value="id" />
	<br><br><input type="text" name="nama" placeholder="Username..." value="" id="nama"/>
	<br><br><input type="text" name="password" placeholder="Password..." id="pass"/>
	<br><br><label class="labe-container">Pilih Jabatan</label>
		<select name="jabatan" class="combo">
			<optgroup><option value="admin">Admin</option></optgroup>
			<optgroup><option value="pegawai">pegawai</option></optgroup>
			<optgroup><option value="kurir">kurir</option></optgroup>
		</select>
		<br><br><a href="<?=base_url('');?>admin/home" class="submit btn-submit hvr-radial-out"></a>
	  <button class="hvr-radial-out button" type="submit">Simpan</button>
	</div>
	</div>
</form>
</center>
</div>