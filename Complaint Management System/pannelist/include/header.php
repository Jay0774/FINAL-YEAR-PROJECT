<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		CMS | Pannelist
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
					<ul class="nav pull-right">
						<li><a href="#">
							<?php 
								$c = $_SESSION['college'];
								$s = mysqli_query($bd, "SELECT categoryName FROM `category` WHERE id = $c");
								$r = mysqli_fetch_array($s);
								$col = $r['categoryName'];
								echo "$col PANNEL";
							?>
						</a></li>
						<li class="nav-user dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="images/images.jpg" class="nav-avatar" />
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="change-password.php">Change Password</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
