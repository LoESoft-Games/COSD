<!DOCTYPE HTML>
<?php
	//Time to code something interesting...
	$myVariable = 345634563655;
	$myOtherVar = 3457623;

	function calculate($var1, $var2) {
		$formula = $var1 / $var2;
		//too long? lets format it? lets go
		$format_myResult = number_format($formula,2);
		return $format_myResult;
	}
?>
<html>
	<head>
		<title>
			Title of Page
		</title>
	</head>
	<!-- Let's add a script when clicked on second div -->
	<script type="text/javascript">
		function onClickDoSomething() {
			alert("Hey! What's up?");
		}
	</script>
	<!-- Let's add a style for this page -->
	<style>
		/*
			It's a comment in CSS none of viewer can read it
		*/
		/*
			Bellow is a class parameter for each element in page
			that you want to add a style (design)
		*/
		.first {
			border: 1px solid black;
			background: #363636;
			text-shadow: 1px 0px 1px #121212;
			text-align: center;
			color: white;
		}
		.second-div {
			border: 2px dashed red;
			background: yellow;
			text-align: center;
		}
	</style>
	<body>
		<div class="first">
			<h1><u>Hello world!</u></h1>
			<br>
			<h3>I want it on another line...</h3>
		</div>
		<!-- It's a comment in HTML none of viewer can read it -->
		<hr>
		<div class="second-div" onClick="javascript:onClickDoSomething()">
			<b>Here another text.</b><br>
			Here is a result: <b><?php echo calculate($myVariable, $myOtherVar)?></b>
		</div>
	</body>
</html>
