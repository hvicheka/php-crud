<?php include_once('config.php'); ?>

<!doctype html>

<html lang="en-US">

<head>
	<?php include(BASE_URL . '/include/layout/style.php') ?>
	<title>All User</title>
</head>

<body>

	<?php

	$condition	=	'';
	if (isset($_REQUEST['username']) and $_REQUEST['username'] != "") {
		$condition	.=	' AND username LIKE "%' . $_REQUEST['username'] . '%" ';
	}
	if (isset($_REQUEST['useremail']) and $_REQUEST['useremail'] != "") {
		$condition	.=	' AND useremail LIKE "%' . $_REQUEST['useremail'] . '%" ';
	}
	if (isset($_REQUEST['userphone']) and $_REQUEST['userphone'] != "") {
		$condition	.=	' AND userphone LIKE "%' . $_REQUEST['userphone'] . '%" ';
	}

	//Main queries
	$pages->default_limit	=	15;
	$sql 	= $db->getRecFrmQry("SELECT * FROM users WHERE 1 " . $condition . "");
	$pages->items_total	=	count($sql);
	$pages->mid_range	=	9;
	$pages->paginate();

	$users	=   $db->getRecFrmQry("SELECT * FROM users WHERE 1 " . $condition . " ORDER BY id DESC " . $pages->page_links . "");

	?>

	<div class="container">

		<div class="card">

			<div class="card-header">
				<strong>All User</strong> 
				<a href="add-users.php" class="float-right btn btn-primary btn-sm">
					<i class="fa fa-fw fa-plus-circle"></i> 
					Add Users
				</a>
			</div>

			<div class="card-body">

				<?php

				if (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rds") {

					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rus") {

					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rnu") {

					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "ras") {

					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
				} elseif (isset($_REQUEST['msg']) and $_REQUEST['msg'] == "rna") {

					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';
				}

				?>

				<div class="col-sm-12">
					<form method="get">
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="d-flex justify-content-start align-items-center gap-3" style="gap: 10px">
									<div>
										<input type="text" name="q" id="q" class="form-control" value="<?= @$_REQUEST['username'] ?? '' ?>" placeholder="search....">
									</div>
									<div>
										<button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
									</div>
									<div>
										<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

			</div>

		</div>

		<hr>

		<div>

			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<th>#</th>
						<th>User Name</th>
						<th>User Email</th>
						<th>User Phone</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($users) > 0) {
						foreach ($users as $key => $val) {
					?>
							<tr>
								<td><?php echo ++$key; ?></td>
								<td><?php echo $val['username']; ?></td>
								<td><?php echo $val['useremail']; ?></td>
								<td><?php echo $val['userphone']; ?></td>
								<td align="center">
									<a href="edit-users.php?editId=<?php echo $val['id']; ?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> |
									<a href="delete.php?delId=<?php echo $val['id']; ?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
								</td>

							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td colspan="5" align="center">No Record(s) Found!</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12 ">
				<?php if ($pages->items_total > 0) { ?>
					<?php echo $pages->display_pages(); ?>
					<?php echo $pages->display_items_per_page(); ?>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="clearfix"></div>

	</div>
	<?php include(BASE_URL . '/include/layout/script.php'); ?>
</body>

</html>