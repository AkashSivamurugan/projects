<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Route Map</title>
</head>
<body>
	<h1>Thiruthuraipoondi---To---Vedaraniyam</h1>
	<!-- css style need to be done-->
	<h1>@10:00 Am</h1>
	<div class="container">
  <div class="progress-container">
    <div class="progress" id="progress"> </div>
    <a href="https://maps.app.goo.gl/QVz7uNBNgkB8N9m3A"><div class="circle active">10:00 </div></a>
    <a href="https://maps.app.goo.gl/ycXdqf5hxQqvj7nq5"><div class="circle">10:10 </div></a>
    <a href="https://maps.app.goo.gl/ycXdqf5hxQqvj7nq5"><div class="circle">10:20 </div></a>
    <a href="https://maps.app.goo.gl/ycXdqf5hxQqvj7nq5"><div class="circle">10:30 </div></a>
    <a href="https://maps.app.goo.gl/ycXdqf5hxQqvj7nq5"><div class="circle">10:40 </div></a>
  </div>
</div>
<div class="section one" id="section1">
		10 : 00 AM Stopping<div>
		PLACE X</div>
	</div>
	<div class="section two" id="section2">
		10 : 10 AM Stopping
		<div>
			Place Y
		</div>
	</div>
	<div class="section three" id="section3">
		10 : 20 AM Stopping
	<div>
		Place Z
	</div>
	</div>
	<div class="section four " id="section4">
		10 : 30 AM Stopping
	<div>
		Place W
	</div>
	<div class="section five" id="section5">
		10 : 40 AM Stopping <div>
		Place T</div>
	   
		
	</style>


	</div>
<style>


@import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap');


:root {
  --line-border-fill: #3498db;
  --line-border-empty: #e0e0e0;
}


* {
  padding: 0;
  margin: 0;
  border: 0;
  box-sizing: inherit;
}

html {
  box-sizing: border-box;
}

body {
  background: #F3F4F6;
  font-family: "Rubik", sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  overflow: hidden;
  margin: 0;
}
.section {
			width: 40vw;
			height: 13vh;
			background-color: blue;
			font-size: 30px;
			color: white;
			text-align: left;
			margin: 5px 5px;
		}
		.one,.three,
		.five {
			background-color: black;
		}


.container {
  margin-top: 0px;
  text-align: center;
  padding: 0px;
}

.progress-container::before {
  content: "";
  background: var(--line-border-empty);
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  height: 4px;
  width: 100%;
  z-index: -1;
}

.progress-container {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin-bottom: 30px;
  max-width: 100%;
  width: 350px;
}

.progress {
  background: var(--line-border-fill);
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  height: 4px;
  width: 0%;
  z-index: -1;
  transition: 0.4s ease;
}

.circle {
  background: #fff;
  color: #999;
  border-radius: 50%;
  height: 50px;
  width: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 3px solid var(--line-border-empty);
  transition: .4s ease;
}

.circle.active {
  border-color: var(--line-border-fill);
}

.btn {
  background-color: var(--line-border-fill);
  color: #fff;
  cursor: pointer;
  font-family: inherit;
  border: 0;
  border-radius: 6px;
  padding: 8px 30px;
  margin: 5px;
  font-size: 14px;
}

.btn:active {
  transform: scale(0.98);
}

.btn:focus {
  outline: 0;
}

.btn:disabled {
  background-color: var(--line-border-empty);
  cursor: not-allowed;
}
</style>

</body>
</html>