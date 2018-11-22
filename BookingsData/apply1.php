<!--
    Written by Motheo
    Mastered by Motsi
-->

<html lang="en">
<head>
	<!-- Meta tags -->
	<title>Venue Application</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- stylesheets -->
	<link rel="stylesheet" href="css/app1style.css">
	<!-- google fonts  -->
	<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,700" rel="stylesheet">
</head>
<body>
	<div class="w3ls-banner">
	<div class="heading">
				<h1>Venue Application Form</h1>
	</div>
		<div class="container">
			<div class="agile-form">
				<form action="../file/apply1PHP.php" method="post">
					<ul class="field-list">
                        <li>
                            <label class="form-label">
                                Select Course:
                                <span class="form-required"> * </span>
                            </label>
                            <div class="form-input drop">
                                <span class="form-sub-label">
                                    <select name="course">
                                       <?php include_once("getCourses.php"); ?>
                                    </select>
                                </span>
                            </div>
                        </li>
                        <li>
                            <label class="form-label">
                                Select Class:
                                <span class="form-required"> * </span>
                            </label>
                            <div class="form-input drop">
                                <span class="form-sub-label">
                                    <select name="class">
                                        <option>&nbsp;</option>

                                    </select>
                                </span>
                            </div>
                        </li>

					</ul>
                    <a href="index.php" class="button" id="back"> Back </a>
                    <a href="#" class="button" id="finish" > Finish </a>
                    <input type="submit" name="submit" class="button" id="submit_button" value="next">
				</form>	
			</div>
		</div>
	</div>
	</div>
</body>
</html>