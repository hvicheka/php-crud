<?php include_once('config.php');

if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {

	extract($_REQUEST);

	if ($username == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=un');

		exit;
	} elseif ($useremail == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=ue');

		exit;
	} elseif ($userphone == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=up');

		exit;
	} else {



		$userCount	=	$db->getQueryCount('users', 'id');

		if ($userCount[0]['total'] < 100) {

			$data	=	array(

				'username' => $username,

				'useremail' => $useremail,

				'userphone' => $userphone,

			);

			$insert	=	$db->insert('users', $data);

			if ($insert) {

				header('location:index.php?msg=ras');

				exit;
			} else {

				header('location:index.php?msg=rna');

				exit;
			}
		} else {

			header('location:' . $_SERVER['PHP_SELF'] . '?msg=dsd');

			exit;
		}
	}
}

?>

<!doctype html>
<html lang="en-US">

<head>
	<?php include(BASE_URL . '/include/layout/style.php') ?>
	<title>Add User</title>
</head>

<body>

	<div class="container">

		<div class="card">

			<div class="card-header">
				<strong>Add User</strong>
				<a href="index.php" class="float-right btn btn-primary btn-sm">All Users</a>
			</div>

			<div class="card-body">

				<form method="post">

					<div class="form-group">

						<label>User Name <span class="text-danger">*</span></label>

						<input type="text" name="username" id="username" class="form-control" placeholder="Enter user name" required>

					</div>

					<div class="form-group">

						<label>User Email <span class="text-danger">*</span></label>

						<input type="email" name="useremail" id="useremail" class="form-control" placeholder="Enter user email" required>

					</div>

					<div class="form-group">

						<label>User Phone <span class="text-danger">*</span></label>

						<input type="tel" class="tel form-control" name="userphone" id="userphone" x-autocompletetype="tel" placeholder="Enter user phone" required>

					</div>

					<div class="form-group">

						<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add User</button>

					</div>

				</form>

			</div>

		</div>

	</div>

	<?php include(BASE_URL . '/include/layout/script.php'); ?>

</body>

</html>