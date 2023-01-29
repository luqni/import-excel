<!DOCTYPE html>
<html>
<head>
	<title>Excel Uploading PHP</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php 
require('db_config.php');
$query = "select * from contacts";
$data = $mysqli->query($query);

?>

<div class="container">
	<h1>Excel Upload</h1>

	<form method="POST" action="excelUpload.php" enctype="multipart/form-data">
		<div class="form-group">
			<label>Select Contact</label>
			<select name="contacts" id="contacts">
			<?php
				if ($data->num_rows > 0) {
					// output data of each row
					while($row = $data->fetch_assoc()) {
					echo "<option value=".$row["id"].">".$row["name"]."</option>";
					}
					
				} else {
					echo "0 results";
				}
			?>
			</select>
		</div>
		<div class="form-group">
			<label>Upload Excel File</label>
			<input type="file" name="file" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" name="Submit" class="btn btn-success">Upload</button>
		</div>
		<p>Download Demo File from here : <a href="demo.xlsx"><strong>Demo.xlsx</strong></a></p>
	</form>
</div>


</body>
</html>