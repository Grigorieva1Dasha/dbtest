<html>
<head>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

</head>
<h1 class="display-1" align="center">Автосалон</h1>
<body style="margin-left: 30%; width: 40%" align="center">
	<?php
		include ('resources/functions.php');
		if ($_GET){
			switch ($_GET['function']) {
	            case 'brands':
	                $Functions->show_brands_list();
				break;
				case 'cars':
					$Functions->show_cars_list();
				break;
				case 'clients':
					$Functions->show_clients_list();
				break;
				case 'workers':
					$Functions->show_workers_list();
				break;
				case 'orders_cars':
					$Functions->show_orders_cars_list();
				break;
            }
		}else{
			$Functions->show_main_list();
		}
	?>
</body>
</html>