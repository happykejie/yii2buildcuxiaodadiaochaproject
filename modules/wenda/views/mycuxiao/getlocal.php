<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=lmZLZ77R2a7dDznD114r5g813rXWhUSY"></script>
	<title>IP定位获取当前城市</title>
</head>
<body>
	<div id="allmap"></div>
</body>
</html>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap");
    var point = new BMap.Point(104.06, 30.67);
    map.centerAndZoom(point, 12);

    function myFun(result) {
        var cityName = result.name;
        map.setCenter(cityName);
        alert("当前定位城市:" + cityName);
    }
    var myCity = new BMap.LocalCity();
    myCity.get(myFun);
</script>
