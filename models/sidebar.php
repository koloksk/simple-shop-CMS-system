	<style>
		/* Style dla sidebaru */
		.sidebar {
			background-color: #282c34;
			color: #fff;
			height: 100%;
			left: 0;
			position: fixed;
			top: 0;
			width: 200px;
		}

		.user-info {
			align-items: center;
			display: flex;
			margin: 20px;
		}

		.avatar {
			border-radius: 50%;
			height: 40px;
			margin-right: 10px;
			width: 40px;
		}

		.sidebar ul {
			list-style: none;
			margin: 20px 0;
			padding: 0;
		}

		.sidebar li {
			padding: 10px;
		}

		.sidebar li:hover {
			background-color: #3f4248;		}
		.sidebar a {
			color: #fff;
			display: flex;
			align-items: center;
			text-decoration: none;
		}

		.sidebar li.active {
			background-color: #3f4248;
		}

		.sidebar i {
			font-size: 24px;
			margin-right: 5px;
		}
	</style>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.1.96/css/materialdesignicons.min.css">

	<!-- Sidebar -->
	<div class="sidebar">
		<div class="user-info">
			<img src="https://www.w3schools.com/howto/img_avatar.png" alt="avatar" class="avatar">
			<div>
				<p>Witaj,</p>
				<p><?php echo $_SESSION['username']; ?>!</p>
			</div>
		</div>
		<ul>
		<li></li>

			<li><a href="./"><i class="mdi mdi-view-dashboard"></i>Dashboard</a></li>
			<br>

			<li><a href="./offers.php"><i class="mdi mdi-tag"></i>Oferty</a></li>
			<li><a href="./pages.php"><i class="mdi mdi-file"></i>Podstrony</a></li>
			<li><a href="./orders.php"><i class="mdi mdi-clipboard-text-clock"></i>Zamówienia</a></li>

			<li><a href="./accounts.php"><i class="mdi mdi-account-group"></i>Użytkownicy</a></li>
			<li><a href="./settings.php"><i class="mdi mdi-cog"></i>Ustawienia</a></li>
			<li><a href="../"><i class="mdi mdi-home"></i>Przejdz do strony</a></li>
			<br>
			<li><a href="../logout.php"><i class="mdi mdi-logout"></i>Wyloguj</a></li>
		</ul>
	</div>