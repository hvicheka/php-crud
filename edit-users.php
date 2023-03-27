<?php include_once('config.php');

if (isset($_REQUEST['editId']) and $_REQUEST['editId'] != "") {

	$row	=	$db->getAllRecords('users', '*', ' AND id="' . $_REQUEST['editId'] . '"');
}



if (isset($_REQUEST['submit']) and $_REQUEST['submit'] != "") {

	extract($_REQUEST);

	if ($username == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=un&editId=' . $_REQUEST['editId']);

		exit;
	} elseif ($useremail == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=ue&editId=' . $_REQUEST['editId']);

		exit;
	} elseif ($userphone == "") {

		header('location:' . $_SERVER['PHP_SELF'] . '?msg=up&editId=' . $_REQUEST['editId']);

		exit;
	}

	$data	=	array(

		'username' => $username,

		'useremail' => $useremail,

		'userphone' => $userphone,

	);

	$update	=	$db->update('users', $data, array('id' => $editId));

	if ($update) {

		header('location: index.php?msg=rus');

		exit;
	} else {

		header('location: index.php?msg=rnu');

		exit;
	}
}

?>

<!doctype html>

<html lang="en-US">

<head>
	<?php include(BASE_URL . '/include/layout/style.php') ?>
	<title>Edit User</title>
</head>

<body>

	<div class="container">

		<?php

		if (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "un") {

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';
		} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "ue") {

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';
		} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "up") {

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';
		} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "ras") {

			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
		} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rna") {

			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';
		}

		?>

		<div class="card">

			<div class="card-header">
				<strong>Edit User</strong>
				<a href="index.php" class="float-right btn btn-primary btn-sm">All User</a>
			</div>

			<div class="card-body">
				<form method="post">
					<div class="form-group">
						<label>User Name <span class="text-danger">*</span></label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($row[0]['username']) ? $row[0]['username'] : ''; ?>" placeholder="Enter user name" required>
					</div>
					<div class="form-group">
						<label>User Email <span class="text-danger">*</span></label>
						<input type="email" name="useremail" id="useremail" class="form-control" value="<?php echo isset($row[0]['useremail']) ? $row[0]['useremail'] : ''; ?>" placeholder="Enter user email" required>
					</div>

					<div class="form-group">
						<label>User Phone <span class="text-danger">*</span></label>
						<input type="tel" class="tel form-control" name="userphone" id="userphone" x-autocompletetype="tel" value="<?php echo isset($row[0]['userphone']) ? $row[0]['userphone'] : ''; ?>" placeholder="Enter user phone" required>
					</div>

					<div class="form-group">
						<input type="hidden" name="editId" id="editId" value="<?php echo isset($_REQUEST['editId']) ? $_REQUEST['editId'] : '' ?>">
						<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update User</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include(BASE_URL . '/include/layout/script.php'); ?>

</body>

</html>