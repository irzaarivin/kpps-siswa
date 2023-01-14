<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KPPS</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/aos.css">
	<link rel="stylesheet" type="text/css" href="css/slick.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
	<script src="{{ env('APP_URL') }}/js/sweetalert.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<body>

	@if(session('masuk'))

		<script>
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: '{{ auth()->user()->nama }}',
				showConfirmButton: false,
				timer: 1500
			});
		</script>

	@endif

	<nav>
		<div class="navigation">
			<div id="keDocuments" class="dokumen item"><p><i class="bi bi-journals"></i></p></div>
			<div id="keHome" class="home item"><p><i class="bi bi-speedometer2"></i></p></div>
			<div id="keNotes" class="pelanggaran item"><p><i class="bi bi-info-circle"></i></p></div>
		</div>
	</nav>

	<div id="home">
		<div class="background-pr"></div>
		<h1 class="poin">KPPS</h1>
		<div class="point" id="poin">
			<div class="poinItem">
				<div class="circle">
					<h1>{{ auth()->user()->pelanggaran }}</h1>
				</div>
				<p>Pelanggaran</p>
			</div>
			<div class="poinItem">
				<div class="circle">
					<h1>{{ auth()->user()->prestasi }}</h1>
				</div>
				<p>Prestasi</p>
			</div>
		</div>
		<p class="name" data-aos="fade-up">{{ auth()->user()->nama }}</p>
		<div class="box">
			<h3>Data Pembinaan Dan Prestasi Siswa Tahun 2022-2023</h3>
			<br><hr><br>
			<h3>Siswa</h3>
			<br><hr><br>
			<p><b>Kelas : </b>{{ strtoupper(auth()->user()->kelas) }}</p>
			<p><b>NIS : </b>{{ auth()->user()->nis }}</p>
			<p><b>Alamat : </b>{{ auth()->user()->alamat }}</p>
			<p><b>No Telepon : </b>{{ auth()->user()->telepon }}</p>
		</div>
		<div class="box">
			<h3>Orang Tua/Wali</h3>
			<br><hr><br>
			<p><b>Ayah : </b>{{ auth()->user()->ayah }}</p>
			<p><b>Ibu : </b>{{ auth()->user()->ibu }}</p>
			<p><b>Alamat : </b>{{ auth()->user()->alamatWali }}</p>
			<p><b>No Telepon : </b>{{ auth()->user()->teleponWali }}</p>
		</div>
	</div>

	<div id="documents">
		<div class="menuDocs">
			<div id="keDocs" class="item">
				<i class="bi bi-folder"></i>
			</div>
			<div id="tambahDokumen" class="item">
				<i class="bi bi-plus-lg"></i>
			</div>
			<div id="keIzin" class="item">
				<i class="bi bi-card-text"></i>
			</div>
		</div>

		<div id="content">

			<div id="myDocs" class="item">

				<h1>Dokumen</h1>

				<div class="switch">
					<div id="pribadi" class="jenis">
						Pribadi
					</div>
					<div id="publik" class="jenis">
						Publik
					</div>
				</div>

				<div id="dokumenPribadi" class="isiDocs">
					<h2>Pribadi</h2><br>

					@if($dokumenPribadi->count())

						@foreach($dokumenPribadi as $data)

							<a href="{{ $data->link }}" class="dokumenAsli">
								<div class="thumb">
									{!! $data->icon !!}
								</div>
								<div class="detail">
									<h3>{{ $data->judul }}</h3>
									<p>type : {{ strtoupper($data->type) }}</p>
								</div>
							</a>

						@endforeach

					@else

						<p>Belum ada dokumen</p>

					@endif

				</div>

				<div id="dokumenPublik" class="isiDocs">
					<h2>Publik</h2><br>

					@if($dokumenPublik->count())

						@foreach($dokumenPribadi as $data)

							<div class="dokumenAsli">
								<div class="thumb">
									{!! $data->icon !!}
								</div>
								<div class="detail">
									<h3>{{ $data->judul }}</h3>
									<p>type : {{ strtoupper($data->type) }}</p>
									<a href="{{ $data->link }}">Lihat</a>
								</div>
							</div>

						@endforeach

					@else

						{{-- <p>Belum ada dokumen</p> --}}

						<p><i>Coming Soon</i></p>

					@endif

					<p><i>note : semua file yang anda unggah di publik, akan terlihat dan bisa diakses oleh semua guru.</i></p>
				</div>

				<script>
					$(document).ready(function(){

						var tomPrib = document.getElementById("pribadi");
						var tomPub = document.getElementById("publik");

						document.getElementById("dokumenPublik").style.display = "none";
						document.getElementById("dokumenPribadi").style.display = "none";

						tomPrib.addEventListener('click', function(){
							// document.getElementById("dokumenPublik").style.display = "none";
							// return document.getElementById("dokumenPribadi").style.display = "block";

							$('#dokumenPublik').hide("500", function(){
								$('#dokumenPribadi').show("500");
							});
						});

						tomPub.addEventListener('click', function(){
							// document.getElementById("dokumenPribadi").style.display = "none";
							// return document.getElementById("dokumenPublik").style.display = "block";

							$('#dokumenPribadi').hide("500", function(){
								$('#dokumenPublik').show("500");
							});
						});

					});
				</script>

			</div>

			<div id="tambahDocs" class="item">

				@if(session('dokumen'))

					<script>
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: '{{ session('dokumen') }}',
							showConfirmButton: false,
							timer: 1500
						});
					</script>

				@endif

				<h1>Tambah Dokumen</h1>

				<form action="" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="box">
						<h3>Judul</h3>
						<input type="text" name="judul" placeholder="..." required>
					</div><br><br>
					<div class="box">
						<h3>Pilih file anda</h3>
						<input type="file" name="file" placeholder="..." required>
					</div><br><br>
					<div class="box">
						<h3>Visibilitas</h3>
						<select name="visibilitas" id="visibilitas" required>
							<option value="private" selected>Pribadi</option>
							<option value="public" disabled>Publik - <i>Coming Soon</i></option>
						</select>
					</div><br><br>
					<button type="submit" name="unggah">Unggah</button>
				</form>

			</div>

			<div id="izin" class="item">
				<h1>Catatan Guru</h1>

				@if($catatan->count())

					@foreach($catatan as $data)

						<div class="box">
							<h3>{{ $data->author }}</h3>
							<p>{{ $data->catatan }}</p>
						</div>

					@endforeach

				@else

					<p>Belum ada catatan dari guru anda</p>

				@endif
			</div>
			
		</div>

		<script>
			$(document).ready(function(){

				var keDocs = document.getElementById('keDocs');
				var tambahDokumen = document.getElementById('tambahDokumen');
				var keIzin = document.getElementById('keIzin');

				tambahDocs.style.display = 'none';
				izin.style.display = 'none';

				keDocs.addEventListener('click', function(){
					document.getElementById('izin').style.display = 'none';
					document.getElementById('tambahDocs').style.display = 'none';
					return document.getElementById('myDocs').style.display = 'block';
				});

				tambahDokumen.addEventListener('click', function(){
					document.getElementById('izin').style.display = 'none';
					document.getElementById('myDocs').style.display = 'none';
					return document.getElementById('tambahDocs').style.display = 'block';
				});

				keIzin.addEventListener('click', function(){
					document.getElementById('tambahDocs').style.display = 'none';
					document.getElementById('myDocs').style.display = 'none';
					return document.getElementById('izin').style.display = 'block';
				});

			});
		</script>
	</div>

	<div id="info">

		<div id="menuInfo" class="content">
			<h1>Pengaturan</h1>

			<div class="menuInfo">
				<div id="infoSiswa" class="item">
					<p>Info Saya</p><i class="bi bi-person-check-fill"></i>
				</div>
				<div id="infoOrtu" class="item">
					<p>Info Wali</p><i class="bi bi-people-fill"></i>
				</div>
			</div>

			<div class="menuInfo">
				<div id="kePelanggaran" class="item">
					<p>Daftar Pelanggaran</p><i class="bi bi-clipboard-x-fill"></i>
				</div>
				<div id="kePrestasi" class="item">
					 <p>Daftar Prestasi</p><i class="bi bi-clipboard-check-fill"></i>
				</div>
				<div id="keGuru" class="item">
					<p>Daftar Guru Administrator</p><i class="bi bi-person-lines-fill"></i>
				</div>
			</div>

			<div class="menuInfo">
				<div id="keLogout" class="item">
					<p>Logout</p><i class="bi bi-box-arrow-right"></i>
				</div>
			</div>

		</div>

		<div id="infoSaya" class="content">
			<h1>Info Saya</h1>
			<div class="menuInfo">
				<div id="keDataDiri" class="item">
					<p>Data Diri</p><i class="bi bi-person-check-fill"></i>
				</div>
				<div id="kePelanggaranSaya" class="item">
					<p>Pelanggaran Saya</p><i class="bi bi-card-list"></i>
				</div>
				<div id="kePrestasiSaya" class="item">
					<p>Prestasi Saya</p><i class="bi bi-card-list"></i>
				</div>
				<hr>
				<div id="backInfoSaya" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<div id="dataDiri" class="content">

			@if(session('dataDiri'))

				<script>
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: '{{ session('dataDiri') }}',
						showConfirmButton: false,
						timer: 1500
					});
				</script>

			@endif

			<h1>Data Diri</h1>
			<form action="/simpanDataDiri" method="POST">
				@csrf
				<div class="box">
					<label>Nama :</label><br>
					<input type="text" name="nama" value="{{ $dataDiri[0]->nama }}" placeholder="..." required>
				</div>
				<div class="box">
					<label>NIS :</label><br>
					<input type="text" name="nis" value="{{ $dataDiri[0]->nis }}" placeholder="..." required disabled>
				</div>
				<div class="box">
					<label>Kelas :</label><br>
					<input type="text" name="kelas" value="{{ strtoupper($dataDiri[0]->kelas) }}" placeholder="..." required disabled>
				</div>
				<div class="box">
					<label>Jurusan :</label><br>
					<input type="text" name="jurusan" value="{{ strtoupper($dataDiri[0]->jurusan) }}" placeholder="..." required disabled>
				</div>
				<div class="box">
					<label>Alamat :</label><br>
					<input type="text" name="alamat" value="{{ $dataDiri[0]->alamat }}" placeholder="..." required>
				</div>
				<div class="box">
					<label>Telepon :</label><br>
					<input type="text" name="telepon" value="{{ $dataDiri[0]->telepon }}" placeholder="..." required>
				</div>
				<div class="box">
					<button type="submit" name="simpan">Simpan</button><br><br>
					<button id="backDataDiri" type="button">Kembali</button>
				</div>
			</form>
		</div>

		<div id="pelanggaranSaya" class="content">
			<h1>Pelanggaran Saya</h1>
			<div class="menuInfo">

				@if($pelanggaranSaya->count())

					@foreach($pelanggaranSaya as $data)

						<div class="item list">
							<p>{{ $data->pelanggaran }}</p><p>{{ $data->poin }}</p>
						</div>

					@endforeach

				@else

					<div class="item list">
						<p>Anda belum memiliki pelanggaran</p>
					</div>

				@endif

				<hr>
				<div id="backPelanggaranSaya" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<div id="prestasiSaya" class="content">
			<h1>Prestasi Saya</h1>
			<div class="menuInfo">

				@if($prestasiSaya->count())

					@foreach($prestasiSaya as $data)

						<div class="item list">
							<p>{{ $data->prestasi }}</p><p>{{ $data->poin }}</p>
						</div>

					@endforeach

				@else

					<div class="item list">
						<p>Anda belum memiliki prestasi</p>
					</div>

				@endif

				<hr>
				<div id="backPrestasiSaya" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<div id="infoWali" class="content">

			@if(session('dataWali'))

				<script>
					Swal.fire({
						position: 'center',
						icon: 'success',
						title: '{{ session('dataWali') }}',
						showConfirmButton: false,
						timer: 1500
					});
				</script>

			@endif

			<h1>Data Wali</h1>
			<form action="/simpanDataWali" method="POST">
				@csrf
				<div class="box">
					<label>Nama Ayah :</label><br>
					<input type="text" name="ayah" value="{{ $dataDiri[0]->ayah }}" placeholder="..." required>
				</div>
				<div class="box">
					<label>Nama Ibu :</label><br>
					<input type="text" name="ibu" value="{{ $dataDiri[0]->ibu }}" placeholder="..." required>
				</div>
				<div class="box">
					<label>Alamat :</label><br>
					<input type="text" name="alamatWali" value="{{ $dataDiri[0]->alamatWali }}" placeholder="..." required>
				</div>
				<div class="box">
					<label>Telepon :</label><br>
					<input type="text" name="teleponWali" value="{{ $dataDiri[0]->teleponWali }}" placeholder="..." required>
				</div>
				<div class="box">
					<button type="submit" name="simpan">Simpan</button><br><br>
					<button id="backInfoWali" type="button">Kembali</button>
				</div>
			</form>
		</div>

		<div id="daftarPelanggaran" class="content">
			<h1>Daftar Pelanggaran</h1>
			<div class="menuInfo">

				@foreach($daftarPelanggaran as $data)

					<div class="item list">
						<p>{{ $data->pelanggaran }}</p><p>{{ $data->poin }}</p>
					</div>

				@endforeach	

				<hr>
				<div id="backDaftarPelanggaran" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<div id="daftarPrestasi" class="content">
			<h1>Daftar Prestasi</h1>
			<div class="menuInfo">

				@foreach($daftarPrestasi as $data)

					<div class="item list">
						<p>{{ $data->prestasi }}</p><p>{{ $data->poin }}</p>
					</div>

				@endforeach	

				<hr>
				<div id="backDaftarPrestasi" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<div id="daftarGuru" class="content">
			<h1>Daftar Guru Administrator</h1>
			<div class="menuInfo">

				@foreach($daftarGuru as $data)

					<div class="item list">
						<p>{{ $data->name }}</p><i class="bi bi-person-fill"></i>
					</div>

				@endforeach	

				<hr>
				<div id="backDaftarGuru" class="item">
					<p>Kembali</p><i class="bi bi-arrow-left-circle-fill"></i>
				</div>
			</div>
		</div>

		<script>
			
			var infoSiswa = document.getElementById("infoSiswa");
			var infoOrtu = document.getElementById("infoOrtu");
			var kePelanggaran = document.getElementById("kePelanggaran");
			var kePrestasi = document.getElementById("kePrestasi");
			var keGuru = document.getElementById("keGuru");
			var keDataDiri = document.getElementById("keDataDiri");
			var kePelanggaranSaya = document.getElementById("kePelanggaranSaya");
			var kePrestasiSaya = document.getElementById("kePrestasiSaya");
			var backInfoSaya = document.getElementById("backInfoSaya");
			var backPrestasiSaya = document.getElementById("backPrestasiSaya");
			var backDataDiri = document.getElementById("backDataDiri");
			var backInfoWali = document.getElementById("backInfoWali");
			var backPelanggaranSaya = document.getElementById("backPelanggaranSaya");
			var backDaftarPelanggaran = document.getElementById("backDaftarPelanggaran");
			var backDaftarPrestasi = document.getElementById("backDaftarPrestasi");
			var kePelanggaran = document.getElementById("kePelanggaran");
			var kePrestasi = document.getElementById("kePrestasi");
			var keGuru = document.getElementById("keGuru");
			var keLogout = document.getElementById("keLogout");

			document.getElementById("infoSaya").style.display = "none";
			document.getElementById("dataDiri").style.display = "none";
			document.getElementById("pelanggaranSaya").style.display = "none";
			document.getElementById("prestasiSaya").style.display = "none";
			document.getElementById("infoWali").style.display = "none";
			document.getElementById("daftarPelanggaran").style.display = "none";
			document.getElementById("daftarPrestasi").style.display = "none";
			document.getElementById("daftarGuru").style.display = "none";

			infoSiswa.addEventListener('click', function(){
				document.getElementById("menuInfo").style.display = "none";
				return document.getElementById("infoSaya").style.display = "block";
			});

			infoOrtu.addEventListener('click', function(){
				document.getElementById("menuInfo").style.display = "none";
				return document.getElementById("infoWali").style.display = "block";
			});

			keGuru.addEventListener('click', function(){
				document.getElementById("menuInfo").style.display = "none";
				return document.getElementById("daftarGuru").style.display = "block";
			});

			keLogout.addEventListener('click', function(){
				return document.location.href = "{{ env('APP_URL') }}/logout?_token={{ csrf_token() }}";
			});

			backDaftarGuru.addEventListener('click', function(){
				document.getElementById("daftarGuru").style.display = "none";
				return document.getElementById("menuInfo").style.display = "block";
			});

			backInfoWali.addEventListener('click', function(){
				document.getElementById("infoWali").style.display = "none";
				return document.getElementById("menuInfo").style.display = "block";
			});

			backInfoSaya.addEventListener('click', function(){
				document.getElementById("infoSaya").style.display = "none";
				return document.getElementById("menuInfo").style.display = "block";
			});

			backDaftarPelanggaran.addEventListener('click', function(){
				document.getElementById("daftarPelanggaran").style.display = "none";
				return document.getElementById("menuInfo").style.display = "block";
			});

			backDaftarPrestasi.addEventListener('click', function(){
				document.getElementById("daftarPrestasi").style.display = "none";
				return document.getElementById("menuInfo").style.display = "block";
			});

			backDataDiri.addEventListener('click', function(){
				document.getElementById("dataDiri").style.display = "none";
				return document.getElementById("infoSaya").style.display = "block";
			});

			backPelanggaranSaya.addEventListener('click', function(){
				document.getElementById("pelanggaranSaya").style.display = "none";
				return document.getElementById("infoSaya").style.display = "block";
			});

			keDataDiri.addEventListener('click', function(){
				document.getElementById("infoSaya").style.display = "none";
				return document.getElementById("dataDiri").style.display = "block";
			});

			kePelanggaran.addEventListener('click', function(){
				document.getElementById("menuInfo").style.display = "none";
				return document.getElementById("daftarPelanggaran").style.display = "block";
			});

			kePelanggaranSaya.addEventListener('click', function(){
				document.getElementById("infoSaya").style.display = "none";
				return document.getElementById("pelanggaranSaya").style.display = "block";
			});

			kePrestasiSaya.addEventListener('click', function(){
				document.getElementById("infoSaya").style.display = "none";
				return document.getElementById("prestasiSaya").style.display = "block";
			});

			kePrestasi.addEventListener('click', function(){
				document.getElementById("menuInfo").style.display = "none";
				return document.getElementById("daftarPrestasi").style.display = "block";
			});

			backPrestasiSaya.addEventListener('click', function(){
				document.getElementById("prestasiSaya").style.display = "none";
				return document.getElementById("infoSaya").style.display = "block";
			});

		</script>

	</div>

	<script>
		
		var keNotes = document.getElementById('keNotes');
		var keHome = document.getElementById('keHome');
		var keDocuments = document.getElementById('keDocuments');

		document.getElementById('info').style.display = "none";
		document.getElementById('documents').style.display = "none";

		keNotes.addEventListener('click', function(){
			document.getElementById('home').style.display = "none";
			document.getElementById('documents').style.display = "none";
			return document.getElementById('info').style.display = "block";
		});

		keHome.addEventListener('click', function(){
			document.getElementById('info').style.display = "none";
			document.getElementById('documents').style.display = "none";
			return document.getElementById('home').style.display = "block";
		});

		keDocuments.addEventListener('click', function(){
			document.getElementById('home').style.display = "none";
			document.getElementById('info').style.display = "none";
			return document.getElementById('documents').style.display = "block";
		});

	</script>

	<script type="text/javascript" src="js/slick.min.js"></script>

	<script>
		$("#poin").slick({
			arrows: false,
			mobileFirst: true,
			infinite: false,
			variableWidth: true,
			centerMode: true,
			centerPadding: '100px'
		});
	</script>

	<script src="js/aos.js"></script>

	<script>
	  	AOS.init();
	</script>
	
</body>
</html>