<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

ini_set('date.timezone','Asia/Shanghai');


//初始化日志
$logHandler= new CLogFileHandler();
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';

//printf_info($order);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<?php
require_once "models/WxJsSdk.php";
$jssdk = new WxJsSdk(WX_APPID, WX_APPSECRET);  
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的未支付订单</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <?=Html::cssFile('@web/web/assets/mui/css/mui.min.css')?>
    <!--App自定义的css-->
    <?=Html::cssFile('@web/web/assets/mui/css/app.css')?>
    <?=Html::cssFile('@web/web/assets/mui/css/css/cxddc.css')?>


          <style>
			.title {
				margin:  20px 15px 10px;
				color: #6d6d72;
				font-size: 15px;
			}

            .cuxiao-little-img {
                width:100px;
                height:67px;
                margin-right:10px;
            }
            .mui-segmented-control>a:last-child
            {
              width:5px;

            }


		</style>

</head>
<body>
    <div id="mui-wrap" class="mui-content" style="overflow-y: auto; position: relative; ">
        <div id="s">
          
            <div>
                <!-- 我的发布 -->
                <div id="item1" class="mui-control-content mui-active">
                    <ul id="cxddc-ul" class="cxddc-ul mui-table-view mui-table-view-striped mui-table-view-condensed">

                       <?php if(count($mypublishitems)>0):?>
                <?php foreach($mypublishitems as $v):?>


                <li class="mui-table-view-cell mui-media">
					<a href="/cxddc/mycuxiao/comfirmorder?id=<?=$v->id?>">
						<img class="cuxiao-little-img !important  mui-pull-left" src="<?=$v->surface?>">
						<div class="mui-media-body">
							<?=$v->name?>
							
						</div>
                           <div class="mui-pull-right">
                           
                                  <p> 共<?=$v->viewcount?>人查看</p>
                         </div>
				</li>


              

                <?endforeach?>
                <?endif?>

                        <?php if(count($mypublishitems)<=0):?>
                        <li style="background-color: #efeff4;">
                            <div style="margin-top: 30px;">
                                <div class="face">
                                    <img src="/web/assets/mui/images/face.png" />
                                </div>
                                <p class="remind-text">您暂时还没有信息哦！</p>
                                <div class="mui-button-row">
                                    <a href="/cxddc/mycuxiao/publishdeclare">
                                        <button type="button" class="mui-btn-primary remind-button">去发布</button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?endif?>
                    </ul>
                </div>
              
            </div>
        </div>
    </div>
    <?=Html::jsFile('@web/web/assets/mui/js/mui.min.js')?>
    <script type="text/javascript">
        mui.init({
            swipeBack: true, //
            tap: true
        });

        /*mui.ready(function(){
        var h = window.innerHeight
        var x = h-40
        x += "px !important"
        console.log(x)
        document.getElementById("mui-wrap").style.height = x 
        console.log($("#mui-wrap").css("height"))
        $("#mui-wrap").css("height",x)
        console.log($("#mui-wrap").css("height"))
        })*/
    </script>


  <input type="hidden" value="<?= $currentuserid?>" id="userid"/>
      	<!--Start 引入分享功能-->
	<?php 
    require(BASE_PATH.'/config/wxfxzhuyejs.php'); ///引入微信分享
    ?> 
    <!--End 结束分享功能-->

</body>
</html>
