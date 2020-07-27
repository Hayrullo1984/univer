
<?php
use yii\bootstrap4\Dropdown;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\Html;
use yii\web\Request;
use yii\helpers\Url;

// $asosiy = null;
$new_bulim = $v_shtats[0]['BULIMID'];
$first = true;
// debug($v_shtats);
// exit;


// foreach ($org as $o){

// 	foreach ($bulim as $b) {
// echo array_search($b->ID,$lavozim);
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['tbn_ln']=$lavozim[0]['IDBULIM']==$b->ID?$lavozim[0]['NAMELAVOZIM']:"yo'q";
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['shbs']=1;
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['yats_br']=1;
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['tf']=1;
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['lo']=[1];
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['u_q']=[1];
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['omxtj']=[1];
// 		$asosiy[$o->NAMEORG][$b->NAMEBULIM]['izoh']="salom";
			
// 	}
// }


// debug($asosiy)
// debug($yil);exit;
?>


<?php
foreach ($yil as $y) {
$items[] = ['label' => $y['YNL'],'url' => Url::current(['date'=>$y['YNL']])];
}
echo ButtonDropdown::widget([
    'label' => 'Tanlang',
    'dropdown' => [
        'items' => $items,
    ],
]);
$items = null;
?>
<?php
foreach ($budkont as $bk) {
$items[] = ['label' => $bk->NAMEBUDKONT,'url' => Url::current(['status'=>$bk->ID])];
}
echo ButtonDropdown::widget([
    'label' => 'Tanlang',
    'dropdown' => [
        'items' => $items,
    ],
]);
?>

 <h2 class="text-center">SHTATLAR JADVALI</h2>
    <h4 class="text-center"><?=$v_shtats[0]['YIL']?>-yil uchun</h4>
    <h2 class="text-center"> <?=$v_shtats[0]['ORG']?></h2>
    
    <div class="container-fluid">	
<table class="table table-bordered text-center">
        <tr>
            <td rowspan="2" >Tarkibiy bo'limlarning nomalnishi va lavozimlar nomi</td>
            <td rowspan="2">Shtat birliklari soni</td>
            <td rowspan="2">YaTS bo'yicha razryadi</td>
            <td rowspan="2">Tarif koeff</td>
            <td colspan="2">Lavozim okladi</td>
            <td colspan="2">Ustama va qo'shimchalar</td>
            <td colspan="2">Oylik mexnat xaq to'lash jamg'armasi</td>
            <td rowspan="2" >Izox</td>

        </tr>
        <tr>
        	        	
            <!-- Lavozim okladi uchun -->
            
            <td><?=$v_shtats[0]['SANA_FIRST']?></td>
            <td><?=$v_shtats[0]['SANA_LAST']?></td>
            <!-- Ustama va qo'shimchalar -->
            <td><?=$v_shtats[0]['SANA_FIRST']?></td>
            <td><?=$v_shtats[0]['SANA_LAST']?></td>
                        <!-- Oylik mehnat xaq to'lash jamg'armasi -->
            <td><?=$v_shtats[0]['SANA_FIRST']?></td>
            <td><?=$v_shtats[0]['SANA_LAST']?></td>
          
        </tr>
        <tr>
            <td colspan="11"></td>
        </tr>
        <tr>
            <?php
            	foreach ($v_shtats as $shtat):
            ?>
            
            	<?php
            	if($shtat['BULIMID']!=$new_bulim)
            	{
            		$new_bulim = $shtat['BULIMID'];	
            		$first = true;
            	}
            	if($first)
            	{
            echo "<tr><td colspan='11'>";
            	
            		echo $shtat['BULIM'];
            		echo "</td></tr>";
            		$first = false;
            	}
            	
            ?>
            	
            
            <td><?=$shtat['LAVOZIM']." ".$shtat['UNVON'].",".$shtat['DARAJA']?></td>
        	<td><?=$shtat['BIRLIK']?></td>
        	<td><?=$shtat['RAZRYAD']?></td>
        	<td><?=$shtat['KOEFF']?></td>

            <!-- Lavozim okladi uchun -->
            <td><?=$shtat['OKLAD_FIRST']?></td>
            <td><?=$shtat['OKLAD_LAST']?></td>


            <!-- Ustama va qo'shimchalar -->
            
            <td><?=$shtat['USTAMA']?></td>
            <td><?=$shtat['USTAMA']?></td>
            

            <!-- Oylik mehnat xaq to'lash jamg'armasi -->
            <td><?=2*$shtat['OKLAD_FIRST']+$shtat['USTAMA']?></td>
            <td><?=2*$shtat['OKLAD_LAST']+$shtat['USTAMA']?></td>
            <td></td>
        </tr>

        

    <?php endforeach;?>
 </table>
    </div>