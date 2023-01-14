<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Authentication</title>
	<link rel="stylesheet" href="auth.css">
	<script src="{{ env('APP_URL') }}/js/sweetalert.js"></script>
</head>
<body>

	@if(session('suksesDaftar'))

		<script>
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: '{{ session('suksesDaftar') }}',
				showConfirmButton: false,
				timer: 1500
			});
		</script>

	@endif

	@if(session('gagalLogin'))

		<script>
			Swal.fire({
				position: 'center',
				icon: 'warning',
				title: '{{ session('gagalLogin') }}',
				showConfirmButton: false,
				timer: 1500
			});
		</script>

	@endif

	<div id="login">

		<div class="img">
			<img src="img/smkn65jkt.png" alt="SMK Negeri 65 Jakarta">
		</div>

		<h1>KPPS</h1>
		<form action="{{ env('APP_URL') }}/login" method="POST">
			@csrf
			<div class="box">
				<label><b>NIS</b></label><br>
				<input type="text" name="nis" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>Email</b></label><br>
				<input type="email" name="email" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>Password</b></label><br>
				<input type="password" name="password" placeholder="..." required>
			</div>
			<button type="submit">Login</button>
		</form>
		<p>Belum memiliki akun?	<br><button id="keRegister">Register Aja</button></p><br><br>
	</div>

	<div id="register">
		<div class="img">
			<img src="img/smkn65jkt.png" alt="SMK Negeri 65 Jakarta">
		</div>
		<h1>KPPS</h1>
		<form action="{{ env('APP_URL') }}/register" method="POST">
			@csrf
			<div class="box">
				<label><b>Nama</b></label><br>
				<input type="text" name="nama" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>NIS</b></label><br>
				<input type="text" name="nis" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>Email</b></label><br>
				<input type="email" name="email" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>Password</b></label><br>
				<input type="password" name="password" placeholder="..." required>
			</div>
			<div class="box">
				<label><b>Kelas</b></label><br>
				<select name="kelas" required>
					<option value="xmm1">X MM 1</option>
					<option value="xmm2">X MM 2</option>
					<option value="xrpl1">X RPL 1</option>
					<option value="xrpl2">X RPL 1</option>
					<option value="xpftv1">X PFTV 1</option>
					<option value="xpftv2">X PFTV 1</option>
					<option value="ximm">XI MM</option>
					<option value="xirpl">XI RPL</option>
					<option value="xipftv">XI PFTV</option>
					<option value="xiimm">XII MM</option>
					<option value="xiirpl">XII RPL</option>
					<option value="xiipftv">XII PFTV</option>
				</select>
			</div>
			<div class="box">
				<label><b>Jurusan</b></label><br>
				<select name="jurusan" required>
					<option value="mm">Multimedia</option>
					<option value="rpl">Rekayasa Perangkat Lunak</option>
					<option value="pftv">Produksi Film & Televisi</option>
				</select>
			</div>
			<input type="hidden" name="pelanggaran" value="0">
			<input type="hidden" name="prestasi" value="0">
			<button type="submit">Register</button>
		</form>
		<p>Belum memiliki akun?	<br><button id="keLogin">Login Aja</button></p>
	</div>

	<script>
		
		var login = document.getElementById("keLogin");
		var register = document.getElementById("keRegister");

		document.getElementById("register").style.display = "none";

		login.addEventListener('click', function(){
			document.getElementById("register").style.display = "none";
			return document.getElementById("login").style.display = "block";
		});

		register.addEventListener('click', function(){
			document.getElementById("login").style.display = "none";
			return document.getElementById("register").style.display = "block";
		})

	</script>
	
</body>
</html>