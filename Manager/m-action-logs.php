<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Action Logs</title>
<style>
        *, body, html{
            overflow: hidden;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
           
        }
        .main{
            height: 100vh;
            display: grid;
            grid-template-rows: 180px 50px 1fr;
            grid-template-columns: 210px 1fr;
            
        }
        .header1{
            background-color: hsla(0, 0%, 0%, 0.425);
            grid-area: 1 / 2 / -4 / 3 ;
        }
        .header1 .bannerlogo{
            width: 1400px;
            height: 275px;
            position: relative;
            object-fit: cover;
            z-index: -1;
        }
        h1{
            font-family: 'Oswald', sans-serif;
            color: hsla(0, 0%, 100%, 0.74);
            position: absolute;
            z-index: 1;
            margin-top: 27px;
            margin-left: 500px;
            font-size: 10vmin;
            -webkit-text-stroke: 4px black;
            letter-spacing: calc(1em / 9);
        }
        .header2{
            background-color: #292929; 
            grid-area: 3 / 2 / -3 / -2;
			border-top-style: solid;
			border-bottom-style: solid;

        }
		.header2 h2{
			color: #ffffff;
			-webkit-text-stroke: 2px black;
			letter-spacing: calc(4em / 15);
			font-weight: bold;
			font-size: 30px;
			margin-top: 2.5px;
			margin-left: 600px;
		}
		 .table_container{
			background-color:#919191;
            grid-area: 3 / 2 / -1 / -1 ;
            
        }

</style>
</head>
<body>

<div class="main">
<?php include "manager_menu.php"?>
<div class="header1">
   <h1>DASHBOARD</h1>
   <img src="bike and helmet.jpg" class="bannerlogo">
</div>
<div class="header2">
     <h2>Action Logs</h2>
</div>
<div class="table_container">

</div>
</div>
</body>
</html>
