 
  function MenuOn(x){
  	if (x>0 && x!=10 ) {
  	   obj=document.getElementById("submenu"+x).style.visibility="visible";  	  	   
    }  	
  	obj=document.getElementById("menu"+x).style.color="#ffffff";  	
  	}
  function MenuOff(x){
  	if (x>0 && x!=10 ){
  	   obj=document.getElementById("submenu"+x).style.visibility="hidden";
    }       
  	obj=document.getElementById("menu"+x).style.color="#000000";
  }

	document.write("<div class='menu'>");
		
		document.write("<div id='menu1' onMouseOver='MenuOn(1)' onMouseOut='MenuOff(1)'>");
		    document.write("<a href='javascript: void(0)'>訂單管理系統</a>");
		    document.write("<div class='submenu1' id='submenu1'>");				
			document.write("<a href='mem11.htm' >訂單查詢與列印</a><span>|</span>");
			document.write("<a href='mem12.htm' >出貨日期設定</a><span>|</span>");		   			
			document.write("<a href='mem13.htm' >檢貨表處理</a><span>|</span>");	
			document.write("<a href='mem14.htm' >出貨處理</a><span>|</span>");		   			
			
			document.write("</div>");
		document.write("</div>");
		
		document.write("<div id='menu2' onMouseOver='MenuOn(2)' onMouseOut='MenuOff(2)'>");
		    document.write("<a href='javascript: void(0)'>商品庫存系統</a>");
		    document.write("<div class='submenu1' id='submenu2'>");			 
			  document.write("<a href='mem21.htm' >商品入庫</a><span>|</span>");
			  document.write("<a href='mem22.htm'>庫存狀況表</a><span>|</span>");
		//	  document.write("<a href='mem22.htm' >供應商資料維護</a><span>|</span>");
		    document.write("</div>");
		document.write("</div>");
		
		document.write("<div id='menu3' onMouseOver='MenuOn(3)' onMouseOut='MenuOff(3)'>");
		    document.write("<a href='javascript: void(0)'>各項資訊查詢</a>");
		    document.write("<div class='submenu1' id='submenu3'>");
			  document.write("<a href='food251.htm' >銷售量查詢</a><span>|</span>");			  	 
		    document.write("</div>");
		document.write("</div>");
		
		document.write("<div id='menu4' onMouseOver='MenuOn(4)' onMouseOut='MenuOff(4)'>");
		    document.write("<a href='javascript: void(0)'>會員管理系統</a>");
		    document.write("<div class='submenu1' id='submenu4'>");			 
			  document.write("<a href='mem41.htm'>會員基本資料</a><span>|</span>");
			  document.write("<a href='http://sms.moding.com.tw/main.jsp;jsessionid=d1e1d82ed4ccaa8664d3606d136a?l=c#mainTabPanel:SMSBroadcastPanel'>簡訊發送系統對接</a><span>|</span>");
			  document.write("<a href='mem42.php'>回饋金明細</a><span>|</span>");	   
		  
			 //document.write("<a href='abc.php'>介紹人維護</a><span>|</span>");
		        document.write("</div>");
		document.write("</div>");
		
		document.write("<div id='menu5' onMouseOver='MenuOn(5)' onMouseOut='MenuOff(5)'>");
		    document.write("<a href='javascript: void(0)'>商品管理系統</a>");
		    document.write("<div class='submenu1' id='submenu5'>");
			  document.write("<a href='mem51.htm' >商品維護</a><span>|</span>");
			//  document.write("<a href='mem52.htm' >一般商品上架</a><span>|</span>");
			//  document.write("<a href='mem53.htm' >特殊商品上架</a><span>|</span>");
			//  document.write("<a href='mem54.htm' >商品類別管理</a><span>|</span>");
			//  document.write("<a href='mem55.htm' >商品價格維護</a><span>|</span>");			 
		    document.write("</div>");
		document.write("</div>");	
		
		document.write("<div id='menu6' onMouseOver='MenuOn(6)' onMouseOut='MenuOff(6)'>");
		    document.write("<a href='javascript: void(0)'>金流管理系統</a>");
		    document.write("<div class='submenu1' id='submenu6'>");
			  document.write("<a href='food251.htm' >帳務管理</a><span>|</span>");
			  document.write("<a href='food252.htm' >銀行對帳單</a><span>|</span>");			 
		    document.write("</div>");
		document.write("</div>");	
		
		document.write("<div id='menu7' onMouseOver='MenuOn(7)' onMouseOut='MenuOff(7)'>");
		    document.write("<a href='javascript: void(0)'>網頁管理系統</a>");
		    document.write("<div class='submenu1' id='submenu7'>");
			  document.write("<a href='mem71.htm' >最新消息管理</a><span>|</span>");
			  // document.write("<a href='mem72.htm' >版面圖片管理</a><span>|</span>");
			  // document.write("<a href='food253.htm' >訊息刊登維護</a><span>|</span>");			  	 
		    document.write("</div>");
		document.write("</div>");
		
		document.write("<div id='menu8' onMouseOver='MenuOn(8)' onMouseOut='MenuOff(8)'>");
		    document.write("<a href='javascript: void(0)'>報表處理</a>");
		    document.write("<div class='submenu1' id='submenu8'>");			 
			  document.write("<a href='mem81.htm' >訂單業績日報表</a><span>|</span>");	
			  document.write("<a href='mem82.htm'>訂單業績月報表</a><span>|</span>");			  
			  document.write("<a href='mem83.htm' >已出貨對帳單</a><span>|</span>");
			  document.write("<a href='mem84.htm' >庫存報表</a><span>|</span>");
		    document.write("</div>");
		document.write("</div>");		
	document.write("</div>"); 
	
	
	
	
	
	
	                                           