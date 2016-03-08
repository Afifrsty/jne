<!DOCTYPE html>
<html>
<head>
	<title>Selamat Datang Karyawan PT.JNE</title>
		<link rel="stylesheet" type="text/css"href="http://localhost/jne/css/loginview.css">
</head>
<body>
<div id="header">
	<center><h1>Selamat Datang Karyawan PT.JNE</h1></center>
</div>
	<div id="font">
		<center><h3>Login Karyawan</h3></center>
	</div>
<div id="kotak">
	<div id="atas">
		<div id="bawah">
			<form method="POST" action="http://localhost/jne/signin">
    			<input type="text" id="username" class="masuk" placeholder="Username..." name="username"/>
    			<input type="password" id="password" class="masuk" placeholder="Password..." name="password"/>
    			<button type="submit" value="login" id="tombol">Masuk</button>
			</form>
		</div>
	</div>
</div>
<div id="footer">
	Copyright &copy; 2015 PT. JNE Indonesia.<br/></b>
</div>

<?php
if($this->session->flashdata('msg') != '') {
	echo '
		<div><button type="button" data-dismiss="alert">&times;</button>'.$this->session->flashdata('msg').'</div>
		';
}
if($this->session->flashdata('success') != '') {
	echo '
		<div><button type="button" data-dismiss="alert">&times;</button>'.$this->session->flashdata('success').'</div>
		';
}
?>

</body>
</html>