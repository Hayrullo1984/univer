<?php
use yii\helpers\Url;
use common\models\Mainmenu;
$models= Mainmenu::find()->all();

?>
<!-- 
       <div id="mySidenav" class="sidenav">
         <a href="#" id="about">About</a>
         <a href="#" id="blog">Blog</a>
         <a href="#" id="projects">Projects</a>
         <a href="#" id="contact">Contact</a>
       </div> -->

       

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" id="clsbtn">&times;</a>
  
  <?php
foreach ($models as $model) {
	echo "<a href=".Url::to([$model->URL]).">".$model->NAMEMMENU."</a>";
}
  ?>
</div>


<?php

$script = <<< JS
	$(".navbar-brand").on('click',function(){
		$("#mySidenav").css("width","250px");
		$(".container").css("margin-left","250px");
		
	});

	$(".closebtn").on('click',function(){
		$("#mySidenav").css("width","0px");
		$(".container").css("margin-left","0px");
		

	});
  

JS;
$this->registerJs($script);

?>