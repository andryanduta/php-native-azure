<html>
 <head>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 <Title>Registration Form</Title>
 <style type="text/css">
	.x_judul{    
    padding: 1px 5px 6px;
    margin-bottom: 10px;
    /* margin-top: 10px; */
    font-weight: bold;
    color: black;
	}
	.x_panel {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px 17px;
    display: inline-block;
    background: #fff;
    border: 1px solid #E6E9ED;
    -webkit-column-break-inside: avoid;
    -moz-column-break-inside: avoid;
    column-break-inside: avoid;
    opacity: 1;
    transition: all .2s ease
}
.x_content {
    padding: 0 5px 6px;
    position: relative;
    width: 100%;
    float: left;
    clear: both;
    margin-top: 5px
}
 </style>
 </head>

 <body>
<div class="container-fluid">
	<div class="col-md-12 col-sm-12 col-xs-12">
		 <div class="x_judul">
			 <h1>Register here!</h1>
			 <p>Fill in your name and IG Account, then click <strong>Submit</strong> to win iPhone X!</p>
		</div>
	</div>
	<div class="container-fluid">
		<div class="x_panel">
			<div class="x_content">
				 <form method="post" action="index.php" enctype="multipart/form-data" class="form-inline">
				       <label class="mr-sm-2 mb-0" for="first_name">First Name</label>
		<!-- 		       <input type="text" name="name" id="name"/></br></br> -->
				       <input type="text" class="form-control mr-sm-2 mb-2 mb-sm-0" id="first_name" name="first_name">
				       <label class="mr-sm-2 mb-0" for="last_name">Last Name</label>
				       <input type="text" class="form-control mr-sm-2 mb-2 mb-sm-0" id="last_name" name="last_name">
				       <label class="mr-sm-2 mb-0" for="instagram">Instagram</label> 
				      <input type="text" class="form-control mr-sm-2 mb-2 mb-sm-0" id="instagram" name="instagram">
				       <input type="submit" class="btn btn-primary mt-2 mt-sm-0" name="submit" value="Submit" />
				       <input type="submit" class="btn btn-danger mt-2 mt-sm-0" style="margin-left: 5px;"name="load_data" value="Load Data" />

				 </form>
				 <?php
				    $host = "adgdicodingappserver.database.windows.net";
				    $user = "andryanduta";
				    $pass = "AzureADG_";
				    $db = "dicodingdb";

				    try {
				        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
				        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				    } catch(Exception $e) {
				        echo "Failed: " . $e;
				    }

				    if (isset($_POST['submit'])) {
				        try {
				            $first_name = $_POST['first_name'];
				            $last_name = $_POST['last_name'];
				            $instagram = $_POST['instagram'];
				            
				            // Insert data
				            $sql_insert = "INSERT INTO Registration (first_name, last_name, instagram) 
				                        VALUES (?,?,?)";
				            $stmt = $conn->prepare($sql_insert);
				            $stmt->bindValue(1, $first_name);
				            $stmt->bindValue(2, $last_name);
				            $stmt->bindValue(3, $instagram);
				            $stmt->execute();
				        } catch(Exception $e) {
				            echo "Failed: " . $e;
				        }

				        echo "<h3>Your're registered!</h3>";
				    } else if (isset($_POST['load_data'])) {
				        try {
				            $sql_select = "SELECT * FROM Registration";
				            $stmt = $conn->query($sql_select);
				            $registrants = $stmt->fetchAll(); 
				            if(count($registrants) > 0) {
				                echo "<h2>People who are registered:</h2>";
				                echo "<table class='table table-sm'>";
				                echo "<tr><th>First Name</th>";
				                echo "<th>Last Name</th>";
				                echo "<th>IG</th>";
				                foreach($registrants as $registrant) {
				                    echo "<tr><td>".$registrant['first_name']."</td>";
				                    echo "<td>".$registrant['last_name']."</td>";
				                    echo "<td>".$registrant['instagram']."</td>";				                    
				                }
				                echo "</table>";
				            } else {
				                echo "<h3>No one is currently registered.</h3>";
				            }
				        } catch(Exception $e) {
				            echo "Failed: " . $e;
				        }
				    }
				 ?>
			</div>
		</div>
	</div>
</div>
 </body>
 </html>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>