<?php

class View {

	function __construct() {
		//echo 'this is the view';
	}

	public function render($name, $noInclude = false)
	{
		require 'views/head.php';
		if ($noInclude == true) {
			require 'views/' . $name . '.php';	
		}
		else {
			$sidebar = "";
			if($name == "user_plant/user_plant_manage")
			$sidebar = "sidebar2";
			else
			$sidebar = "sidebar";
			echo '<body class="sidebar-icon-only">
					<div class="container-scroller">';
			require 'views/header/navbar.php';
			echo '<div class="container-fluid page-body-wrapper">';
			require 'views/header/'.$sidebar.'.php';	
			echo ' <div class="main-panel">
            <div class="content-wrapper">';
			require 'views/' . $name . '.php';
			echo '  </div>';
			require 'views/header/footer.php';	
			echo ' </div>
						
					</div>
					
					</div>
					</body>';
		}
	}

}