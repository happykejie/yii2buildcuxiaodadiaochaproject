
<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

?>

<?php
require_once "models/WxJsSdk.php";
$jssdk = new WxJsSdk(WX_APPID, WX_APPSECRET);  
$signPackage = $jssdk->GetSignPackage();
?>

<!doctype html>
<html>

	<head>
		<meta charset="utf-8">
		<title>促销信息详情</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<!--标准mui.css-->
		  <?=Html::cssFile('@web/web/assets/mui/css/mui.min.css')?>
		<!--App自定义的css-->
		  <?=Html::cssFile('@web/web/assets/cxddc/css/publishdetail.css')?>

	

	</head>

	<body>
		
		<div class="mui-content">
			<div class="mui-content-padded">

            <!--    <div id="bgheadimg" style="height:200px;width:100%;">

                </div>-->

                <div id="headtitle">
                    <?=$item->name?>
                </div>

			     <div id="headimg">
					<img src="<?=$item->surface?>" data-preview-src="" data-preview-group="1" />
				</div>
               <p class="showlable">开始时间:</p>
            <p class="showcontent">  <?=$item->start_time?></p>  
                <p class="showlable">结束时间:</p>
              
                <p class="showcontent">  <?=$item->end_time?> </p> 
                
              <p class="showlable">地址:</p>

              
                <p class="showcontent">  <?=$item->address?></p> 

               <p class="showlable">咨询方式:</p>
               
              
                <p class="showcontent">  <?=$item->contacttype?> </p> 
               
                <p class="showlable">活动介绍:</p>

                <div id="acdescription">   <p class="showcontent"> <?=$item->intro?></p> </div>
             
				

                <div id="cxxc">
                   促销现场
                </div>

               <div id="divdetailimg">


               

                   <?php if(count($arryimg)>0):?>
                <?php foreach($arryimg as $m):?>
                <?php if(strlen($m)>5):?>

                <div class="detailimg">
                      <img src="<?=$m?>" data-preview-src="" data-preview-group="1" />
                </div>

                <?endif?>
                <?endforeach?>
                <?endif?>


                   </div>

                
               
			</div>
              
            
		</div>
          
        <div class ="emptydiv">

            点击右上角分享
            </br></br>
             <p>版权所有：成都阿欢阿杰科技有限公司</p>
        </div>

         <input type="hidden" value="<?= $currentuserid?>" id="userid"/>
         <input type="hidden" value="<?= $item->id?>" id="detailid"/>

       
                 
	</body>
       <?=Html::jsFile('@web/web/assets/mui/js/mui.min.js')?>
       <?=Html::jsFile('@web/web/assets/mui/js/mui.zoom.js')?>
       <?=Html::jsFile('@web/web/assets/mui/js/mui.previewimage.js')?>

     <?=Html::jsFile('@web/web/js/jquery.js')?>

	<script>
	    mui.previewImage();
	</script>

    <!--Start 引入分享功能-->
	<?php 
    require(BASE_PATH.'/config/wxfxdetailjs.php'); ///引入微信分享
    ?> 
    <!--End 结束分享功能-->

</html>