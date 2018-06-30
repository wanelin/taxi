var margin=80;

var BrowserDetect = {
 init: function () {
     this.userAgent = navigator.userAgent;
     this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
     this.version = this.searchVersion(navigator.userAgent)
         || this.searchVersion(navigator.appVersion)
         || "an unknown version";
     this.OS = this.searchString(this.dataOS) || "an unknown OS";
 },

 searchString: function (data) {
     for (var i=0;i<data.length;i++)    {
         var dataString = data[i].string;
         var dataProp = data[i].prop;
         this.versionSearchString = data[i].versionSearch || data[i].identity;
         if (dataString) {
             if (dataString.indexOf(data[i].subString) != -1)
                 return data[i].identity;
         }
         else if (dataProp)
             return data[i].identity;
     }
 },
 searchVersion: function (dataString) {
     var index = dataString.indexOf(this.versionSearchString);
     if (index == -1) return;
     return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
 },
 dataBrowser: [
     {
         string: navigator.userAgent,
         subString: "Edge",
         identity: "Edge",
         icon: "_edge.png"
     },
     {
         string: navigator.userAgent,
         subString: "Chrome",
         identity: "Chrome",
         icon: "_chrome.png"
     },
     {     string: navigator.userAgent,
         subString: "OmniWeb",
         versionSearch: "OmniWeb/",
         identity: "OmniWeb",
         icon: "_omni.png"
     },
     {
         string: navigator.vendor,
         subString: "Apple",
         identity: "Safari",
         versionSearch: "Version",
         icon: "_safari.png"
     },
     {
         prop: window.opera,
         identity: "Opera",
         versionSearch: "Version",
         icon: "_opera.png"
     },

     {

         string: navigator.vendor,
         subString: "iCab",
         identity: "iCab",
         icon: "_icab.jpg"

     },
     {
         string: navigator.vendor,
         subString: "KDE",
         identity: "Konqueror",
         icon: "_unknown.png"  
     },

     {

         string: navigator.userAgent,
         subString: "Firefox",
         identity: "Firefox",
         icon: "_firefox.png"
     },
     {
         string: navigator.vendor,
         subString: "Camino",
         identity: "Camino",
         icon: "_unknown.png"
     },
     {
   // for newer Netscapes (6+)
         string: navigator.userAgent,
         subString: "Netscape",
         identity: "Netscape",
         icon: "_netscape.png"
     },
     {
         string: navigator.userAgent,
         subString: "MSIE",
         identity: "Explorer",
         versionSearch: "MSIE",
         icon: "_ie.png"
     },
     {
         string: navigator.userAgent,
         subString: "Gecko",
         identity: "Mozilla",
         versionSearch: "rv",
         icon: "_unknown.png"
     },
     { 
   // for older Netscapes (4-)
         string: navigator.userAgent,
         subString: "Mozilla",
         identity: "Netscape",
         versionSearch: "Mozilla",
         icon: "_mozilla.png"
     }
 ],
 dataOS : [
 ]
};
//使用方式
BrowserDetect.init();
var browser=BrowserDetect.browser;
var version=BrowserDetect.version ;
var pass="yes";
// console.log(BrowserDetect.userAgent); //完整瀏覽器訊息
// console.log(BrowserDetect.browser); //瀏覽器簡要資訊
// console.log(BrowserDetect.version); //瀏覽器版本資訊
if (!navigator.userAgent.match("Safari"))
{	
	pass="no"
}
var wid=self.innerWidth;
$(window).resize(function() {
  wid=self.innerWidth;
  //alert(wid);
  location.reload();
});
if (pass!="no")
{
  
   if (version<50)
   {
	   alert("瀏覽器版本過舊 : "+browser+"    " + version +" 螢幕寬度"+wid);
		history.go(-1);
   }
   
   if (wid<1150)
	{		
		r="calc(var(--width) - 20vw)";
		$("#grid2").css('font-size','16px');	
		$("#grid02").css('left',r);	
		r="calc(var(--margin) + 26vw)";
		$(".menu_2").css('left',r);
		
	}	
}
else
{
	alert(" 請用與chrome 相容的瀏覽器");
	history.go(-1);
}
function login()
{
	window.open("login.htm", "_self", " ");
}
function search()
{
	search_val=$("#search_val").val();
	search_val=search_val.trim();	
	if (search_val.length<1)
	{
		alert("搜尋不能空白")
	}	
	else
	{
		window.open("hlg1.htm?search_val="+search_val, "_self", " ");
	}
}
//橫向的	
function MenuOn_2(x){
if (x>=0 && x!=30 ) {

   obj=document.getElementById("submenu"+x+"_2").style.visibility="visible";  	  	   
}  	
obj=document.getElementById("menu"+x+"_2").style.color="#ffffff";  	
}
function MenuOff_2(x){
if (x>=0 && x!=30 ){
   obj=document.getElementById("submenu"+x+"_2").style.visibility="hidden";
}       
obj=document.getElementById("menu"+x+"_2").style.color="#000000";
}
var menu_desc=[];
var sub_menu_desc=[];
var sub_menu_url=[];
var sub_menu_num=[];
for (i = 0; i < 20; i++)
{
   sub_menu_desc[i]= [];
   sub_menu_url[i]= [];
}
var f_cust_id="";
var f_class_name;
var f_class_name_a={};
var up_line="";
var down_line="";
var news="";
var filename1={};     //按過的圖片編號
var filename2={};
var filename3={};
var url1={};    //按過的圖片編號
var url2={};
var url3={};
var f_cust_name="";	
var f_cust_tel="";
var f_cust_addr="";
var out="check";
var f_food_id;
var f_food_id_a={};
var f_food_name;
var f_food_name_a={};
var f_price;
var f_price_a={};
var f_path_a={};
var f_path="";
var database;
var database_a={};
var f_mpeg4_a={}; 
var f_food_desc;	
var f_food_desc_a={};
var f_pic;	
var f_pic_a={};  
var f_pic_path;  
$(function() 
{
   
  //  $(window).on('beforeunload', function (e) {
	//	return '你還沒有完成你的文章，就這樣離開了嗎？';
	//   });
	$('a.abgne_gotoheader').click(function(){
			// 讓捲軸用動畫的方式移動到 #header 的 top 位置
			// 並加入動畫效果
			/*var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
			$body.animate({
				scrollTop: $('#header').offset().top
			}, 2000, 'easeOutBounce');*/
			var body = $("html, body");
			body.stop().animate({scrollTop:0}, 500, 'swing', function() {});
			return false;
		});
	$.post('index0.php',
    { 		 
          out : "check" 
    }, 		
    function(data) 
	//回傳資料
	{
		pri_echo=$(data).find('pri_echo').text()		
		//alert(f_cust_id+"test");
		news=$(data).find('news').text();
		$("#news").html(news);		
//alert(news);		
//document.getElementById.("news").innerHTML(news);
		f_cust_id=$(data).find('f_cust_id').text();	
		f_cust_id=f_cust_id.trim();		
		f_cust_name=$(data).find('f_cust_name').text();
		f_cust_name=f_cust_name.trim();
		f_cust_tel=$(data).find('f_cust_tel').text();	
		f_cust_addr=$(data).find('f_cust_addr').text();		
		up_line=$(data).find('up_line').text();	
		down_line=$(data).find('down_line').text();	
		item_num=$(data).find("item_num").text();
		tot_bye_money="$"+$(data).find("tot_bye_money").text();	
		
        if(f_cust_id.length>0)
		{			
			html="<span onclick='show_upline()'><img src='holygo/png/23.png' class='image_width_16px'>&nbsp;&nbsp;"+f_cust_id+f_cust_name+"</span><a href='#'><span onclick='logout()' >登出</span></a>"		
			$("#member").html(html);
		
			$("#grid0182").html(item_num+"筆");
			//$("#grid0181").html(tot_bye_money);
		}
		else
		{
			$("#grid0181").html('');
			$("#grid0182").html('');
		}
		html="";
		j=0; 
		$(data).find("class_name").each(                      //回傳處理多筆資料,先把資料全部取出
			function(i)      //i 傳回陣列索引
			{				
				html+='<a href="#" onclick("class_change()")>'+$(this).text() +'</a><br>';
				f_class_name_a[i]=$(this).text();
				//alert(f_class_name_a[i])
				j=j+1	
			});	
			
		
		
		$(data).find("first_page").each(                      //回傳處理多筆資料,先把資料全部取出
		function(i)
		{ 
		//	filename1[i]=$(this).children("f_pic").text();
		
		    filename1[i]="pic/banner/"+(i+1)+".jpg";
			//url1[i]=$(this).children("f_food_id").text();
		});		
		url1[0]='030100004';
		url1[1]='030100005';
		url1[2]='040100001';
		url1[3]='040200001';
		url1[4]='060100001';
		url1[5]='060100005';
		url1[6]='070200001';
		url1[7]='060100006';
		pic_name=filename1[0]	;
		url_name="hlg_prod_show.htm?f_food_id="+url1[0];
		document.all('show1').src=pic_name;
		document.all('show1_url').href=url_name;
			
		pic_name=filename1[1];	
		url_name="hlg_prod_show.htm?f_food_id="+url1[1];		
		document.all('show2').src=pic_name;
		document.all('show2_url').href=url_name;
		$(data).find("second_page").each(                      //回傳處理多筆資料,先把資料全部取出
		function(i)
		{ 
			filename2[i]=$(this).children("f_pic").text();
			url2[i]=$(this).children("f_food_id").text();
		});
		j3=0;
		$(data).find("third_page").each(                      //回傳處理多筆資料,先把資料全部取出
		function(i)
		{ 
			filename3[i]=$(this).children("f_pic").text();
			url3[i]=$(this).children("f_food_id").text();
			f_food_id_a[i]=$(this).children("f_food_id").text();
			f_food_name_a[i]=$(this).children("f_food_name").text();
			f_price_a[i]=$(this).children("f_price").text();
			
			j3=j3+1;				  
		});
		html="<table border=0><tr>";
		for (i=1;i<10;i++)
		{
			url_name="hlg_prod_show.htm?f_food_id="+url2[i];
			
			html+='<td width=300px><a href="'+url_name+'"><img width=300px src="'+filename2[i]+'" alt="'+i+'"/></a>';
		}
		for (i=1;i<10;i++)
		{
			html+='<td  width=300px><a href="'+url_name+'"><img width=300px src="'+filename2[i]+'" alt="'+i+'"/></a>';
		}	
		html+="</td></tr></table";		
		$("#list").html(html);
		table_width=Math.floor((wid-2*margin));
		//alert(wid+"    "+margin+"     "+table_width);
		img_width=Math.floor((table_width-20)/4);
		if (wid<1150)
		{
			img_width=Math.floor((table_width-100)/4);
		}
		html="<table border=0 width="+table_width+"><tr>";
		for (i=0;i<j3;i++)
		{
			url_name="hlg_prod_show.htm?f_food_id="+url3[i];												
			html+="<td width="+(img_width+3)+"><span><a href='"+url_name+"'><img src='"+filename3[i]+"' width="+img_width+"   onclick='open_window("+i+")'></a></span><br>";						
					
			/*if ((i)%4==0)
			{
				html+="<tr>";
			}
			*/
			if ((i+1)%4==0 || i==(j3-1))	
			{
				if ((i+1)%4==0)	
				{
				   d=3;
				}
				else
				{
					d=i%4;
				}						
				html+="<tr>";
				
				for (ii=i-d;ii<=i;ii++)
				{
					/*html+="<span name='f_food_id' id='"+f_food_id_a[ii]+"'>"+f_food_id_a[ii]+"</span><br>";
					if (f_mpeg4_a[ii].length>0)
					{
						html+="<br><span name='f_food_name' id='f_food_name"+(ii)+"'><a href='"+ f_mpeg4_a[(ii)] +"' target='_blank'>"+f_food_name_a[(ii)]+"</a></span>";
					}
					else
					{
						html+="<br><span name='f_food_name' id='f_food_name"+(ii)+"'>"+f_food_name_a[(ii)]+"</span>";			
					}
					*/
					html+="<td><span name='f_food_name' id='f_food_name"+(ii)+"'>"+f_food_name_a[(ii)]+"</span><br>";					
					html+="單價:<span name='f_price' id='f_real_price"+(ii)+"' style='color:red;font-size: 20pt'>$"+ Math.floor(f_price_a[(ii)])+"</span>";
					
					html+="</td>";
				}	
			
				html+="<tr>";				
			}
			
		}
		

		html+="</table>";
		$("#grid81").html(html);
	});
		

 }); 
   menu_num=10;
  menu_desc[1]="美妝保養";
    sub_menu_num[1]=1;
	sub_menu_desc[1][1]="保養";
	 sub_menu_url[1][1]="hlg1.htm?prod_class=0101";
 menu_desc[2]="營養保健";
    sub_menu_num[2]=1;
	sub_menu_desc[2][1]="養生/保健";
	 sub_menu_url[2][1]="hlg1.htm?prod_class=0201";
 menu_desc[3]="美食特集";
    sub_menu_num[3]=3;
	sub_menu_desc[3][1]="飲品/沖泡";
	 sub_menu_url[3][1]="hlg1.htm?prod_class=0301";
	sub_menu_desc[3][2]="點心/零食";
	 sub_menu_url[3][2]="hlg1.htm?prod_class=0302";
	sub_menu_desc[3][3]="冷凍/生鮮";
	 sub_menu_url[3][3]="hlg1.htm?prod_class=0303";
menu_desc[4]="３Ｃ產品";
    sub_menu_num[4]=2;
	sub_menu_desc[4][1]="娛樂";
	 sub_menu_url[4][1]="hlg1.htm?prod_class=0401";
	sub_menu_desc[4][2]="３Ｃ週邊";
	 sub_menu_url[4][2]="hlg1.htm?prod_class=0402";
menu_desc[5]="家電用品";
    sub_menu_num[5]=4;
	sub_menu_desc[5][1]="季節商品";
	 sub_menu_url[5][1]="hlg1.htm?prod_class=0501";
	sub_menu_desc[5][2]="廚房清理";
	 sub_menu_url[5][2]="hlg1.htm?prod_class=0502";
	sub_menu_desc[5][3]="居家生活";
	 sub_menu_url[5][3]="hlg1.htm?prod_class=0503";	
	sub_menu_desc[5][4]="視聽娛樂";
	 sub_menu_url[5][4]="hlg1.htm?prod_class=0504";	 
menu_desc[6]="日常用品";
    sub_menu_num[6]=2;
	sub_menu_desc[6][1]="盥洗用品";
	 sub_menu_url[6][1]="hlg1.htm?prod_class=0601";
	sub_menu_desc[6][2]="家用清潔";
	 sub_menu_url[6][2]="hlg1.htm?prod_class=0602";	
menu_desc[7]="居家生活";
    sub_menu_num[7]=4;
	sub_menu_desc[7][1]="宗教開運";
	 sub_menu_url[7][1]="hlg1.htm?prod_class=0701";
	sub_menu_desc[7][2]="生活百貨";
	 sub_menu_url[7][2]="hlg1.htm?prod_class=0702";
	sub_menu_desc[7][3]="玩具";
	 sub_menu_url[7][3]="hlg1.htm?prod_class=0703";	
	sub_menu_desc[7][4]="餐廚用品";
	 sub_menu_url[7][4]="hlg1.htm?prod_class=0704";	
menu_desc[8]="傢俱傢飾";
    sub_menu_num[8]=1;
	sub_menu_desc[8][1]="寢具";
	 sub_menu_url[8][1]="hlg1.htm?prod_class=0801";
menu_desc[9]="小農專區";
    sub_menu_num[9]=6;
	sub_menu_desc[9][1]="稻米";
	 sub_menu_url[9][1]="hlg1.htm?prod_class=0901";
	sub_menu_desc[9][2]="五穀雜糧";
	 sub_menu_url[9][2]="hlg1.htm?prod_class=0902";
	sub_menu_desc[9][3]="蔬菜";
	 sub_menu_url[9][3]="hlg1.htm?prod_class=0903";	
	sub_menu_desc[9][4]="水果";
	 sub_menu_url[9][4]="hlg1.htm?prod_class=0904";	
	 sub_menu_desc[9][5]="魚貨";
	 sub_menu_url[9][5]="hlg1.htm?prod_class=0905";	
	 sub_menu_desc[9][6]="肉品";
	 sub_menu_url[9][6]="hlg1.htm?prod_class=0906";	
menu_desc[10]="品牌館";
    sub_menu_num[10]=1;
	sub_menu_desc[10][1]="聲寶館";
	 sub_menu_url[10][1]="hlg1.htm?prod_class=1001";
//	sub_menu_desc[10][2]="國際館";
//	 sub_menu_url[10][2]="hlg1.htm?prod_class=1002";		
	
	document.write("<div class='menu_2'>");  
	for (i=1;i<=menu_num;i++)
	{
		document.write("<div id='menu"+i+"_2' onMouseOver='MenuOn_2("+i+")' onMouseOut='MenuOff_2("+i+")'>");
			document.write("<a href='javascript: void(0)'>"+menu_desc[i]+"</a>");
			document.write("<div class='submenu1_2' id='submenu"+i+"_2'>");			
			for (ii=1;ii<=sub_menu_num[i];ii++)
			{
				document.write("<a href='"+sub_menu_url[i][ii]+"' >"+sub_menu_desc[i][ii]+"</a><span>|</span>");
			}
			document.write("</div>");		
		document.write("</div>");
	}		                              
	document.write("</div>");
	
function show_upline()
{
	alert(up_line);
	alert(down_line);
} 
 function logout()
 {
    $.post('index0.php',
    { 		 
          out : "登出" 
    }, 		
    function(data) 
	//回傳資料
	{
        f_cust_name="";
		f_cust_id="";
		up_line="";
		down_line="";
		html="<span id='member'><img src='holygo/png/23.png' class='image_width_16px'>&nbsp;&nbsp;<a href='#' onclick='login()'>會員登入/註冊</a>"; 
		$("#grid0181").html('');
		$("#grid0182").html('');
		$("#member").html(html);
	});
} 	
function myFunction()
{
   if (window.pageYOffset<10)
   {				
		document.getElementById("grid017").style.visibility = "hidden";
   }
   else
   {
		document.getElementById("grid017").style.visibility = "visible";
   }
}
	
var today = new Date();
document.write("<div id='back1'></div>");
document.write("<div id='grid0'>");
document.write("	<div id='grid01'>");
document.write("		<img src='holygo/png/27.png' class='image_width_16px'><a href=index.htm>&nbsp;&nbsp;回首頁</a>&nbsp;|&nbsp;");
document.write("		<img src='holygo/png/22.png' class='image_width_16px'>&nbsp;&nbsp;<a href='http://www.facebook.com/HOLYGOGO/?fref=ts' target=_new>facebook </a>&nbsp;|&nbsp;&nbsp;");
document.write("	</div>");
document.write("	<div id='grid02'>");
document.write("		<span id='member'><img src='holygo/png/23.png' class='image_width_16px'>&nbsp;&nbsp;<a href='#' onclick='login()' >會員登入/註冊</a></span>");
//document.write("		<a href='hlg_car_show.htm'><img src='holygo/png/24.png' class='image_width_16px'></a>&nbsp;|&nbsp;");
//document.write("		<img src='holygo/png/26.png' class='image_width_16px'>");
document.write("	</div> ");
document.write("</div>");
document.write("<div id='grid1'>");
document.write("	<div id='grid11'>");
document.write("		<a href=index.htm><img src='holygo/png/31.png' class='logo'></a>");
document.write("	</div>");
document.write("	<div id='grid12'>");		
document.write("		<!-- <a href='#'><img src='holygo/png/42.png' class='search'> -->");			
document.write("	</div>");	
document.write("	<div id='grid13'>");
document.write("	</div >");
document.write("</div>");
document.write("<div id='grid2'>");
document.write("<marquee class='marquee'><span id=news></span></marquee>");
document.write("</div>");
document.write("<div id='grid3'>");
//document.write("	<div id='grid31'>");
//document.write("		<img src='holygo/png/64.png' height=32>");
//document.write("	</div>	");
document.write("<div id='grid33'>");
document.write("	</div>");
document.write("</div>");	