var series_posts = [];
var picture_page = "";
var name_page = "";

window.fbAsyncInit = function() {
  FB.init({
    appId      : '1711409385755467',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.
  //FB.Event.subscribe('auth.login', function (response) {
  //	window.location.reload();
  //});

  	FB.getLoginStatus(function(response) {
    	statusChangeCallback(response);
  	});

  	/*FB.ui({
  		method: 'share_open_graph',
  		action_type: 'og.likes',
  		action_properties: JSON.stringify({
    		object:'https://www.instagram.com/underagenda_sv',
  		})
	}, function(response){
  		// Debug response (optional)
  		console.log(response);
	});*/

  };

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      	// Logged into your app and Facebook.
      	//
      	//	authResponse: {
        //		accessToken: '...',
        //		expiresIn:'...',
        //		signedRequest:'...',
        //		userID:'...'
    	//	}
      	var uid = response.authResponse.userID;
        $("#ids_tops_posts").html(uid);
    	var accessToken = response.authResponse.accessToken;
    	var name = response.authResponse.signedRequest;
    	fbGetManagedPages();
    	
      	$('#content_facebook').html("Logout");
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      	$('#content_facebook').html("No authorized yet");
      	fbLogin();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      // checkLoginState();
      	$('#content_facebook').html("Sign in with Facebook");
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  function fbLogin() {
    FB.login(function(response) {
      	if (JSON.response.authResponse) {
        	
      	} else {
      	}
   	}, {perms:'email,public_profile,publish_pages,user_location,user_birthday,publish_actions,publish_pages,manage_pages'});
  }

  function fbLogout(){
  	FB.logout(function(response) {
  		$('#content_facebook').html("Sign in with Facebook");
	});
  }

  $('#click_facebook').click(function(){
  	FB.getLoginStatus(function(response) {
      if(response.status == "connected"){
      	fbLogout();
      }else if(response.status == "not_authorized"){
      	$('#content_facebook').html("Not authorized yet!");
      }else{
      	fbLogin();
      	$('#content_facebook').html("Logout");
      	//window.location.assigns("settings.php");
      }
    });
  });

  $("select").change(function(){
  		var id_page = $( "#list_pages option:selected" ).val();
      fbGetDataPage(id_page);
  		fbGetFansPage(id_page);
  		fbGetTotalReach(id_page);
  		fbPageFansGenderAge(id_page);
  		fbPageViewsLoggedUnique(id_page);
      fbGetAllPosts(id_page);
  });

  function fbGetDataPage(id){
    FB.api('/' + id.toString() + '?fields=id,name,picture', function(response){
        //picture_page = response.picture.data.url;
        name_page = response.name;
        picture_page = response.picture.data.url;
    });
  }

  function fbGetFansPage(id){
  	//196902193689926/insights/page_fans?since=1457078400&until=1457164800
  	var since = mostrarFecha(0);
  	var until = mostrarFecha(1);

  	FB.api('/' + id.toString() + '/insights/page_fans?since=' + since.toString() + '&until=' + until.toString(), function(response){
  	 	$.each(response.data, function(i, item) {
    		var likes = new Intl.NumberFormat("es-MX").format(item.values[0].value);

    		$("#likes_facebook").html(likes.toString());
      		//$("#likes_facebook").html(until);
		});
  	});

  	since = mostrarFecha(-27);
  	until = mostrarFecha(1);
	FB.api('/' + id.toString() + '/insights/page_fans?since=' + since.toString() + '&until=' + until.toString(), function(response){
  	 	$.each(response.data, function(i, item) {
  	 		var inicio = 0;
  	 		var fin = 0;
  	 		var incremento = 0;
  	 		$.each(item.values, function(j, item_2){
  	 			if(j == 0){
  	 				inicio = item_2.value;
  	 			}
  	 			if(j == 27){
  	 				fin = item_2.value;
  	 			}
  	 			
  	 		});
  	 		incremento = 100 -((inicio*100)/fin);
  	 		$("#likes_increses_facebook").html(incremento.toPrecision(3).toString() + " Increase in 28 Days");
    		//var incremento = item.values[0].value;
    		//alert(item.values[0].value;);
    		//$("#likes_increses_facebook").append(incremento);
    		//$("#likes_facebook").html(until);
		});
  	 	//var htmlPages = "<li><a href='#'>" + response.data[0].category + "</a></li>";
  	 	//$("#list_pages").html(htmlPages);
  	 });  	
  }




function fbGetTotalReach(id){
  	
  	var since = mostrarFecha(-7);
  	var until = mostrarFecha(0);
  	var totalReach = 0;
  	var count = 0;
	//196902193689926/insights/page_impressions_unique?since=1456732800&until=1457424000
  	FB.api('/' + id.toString() + '/insights/page_impressions_unique/day?since=' + since.toString() + '&until=' + until.toString(), function(response){
  	 	$.each(response.data, function(i, item) {
  	 		$.each(item.values, function(j, item_2){
  	 			count++;
  	 			totalReach += item_2.value;
  	 		});
    		//var likes = new Intl.NumberFormat("es-MX").format(item.values[0].value);
    		totalReach = totalReach/count;
    		$("#reach_facebook").html(new Intl.NumberFormat("es-MX").format(totalReach.toFixed(2)).toString());
      		//$("#likes_facebook").html(until);
		});
  	});
  }


function fbPageFansGenderAge(id){

	var since   	 = mostrarFecha(-2);
  	var until   	 = mostrarFecha(-1);
  	var genders 	 = "";
  	var valor   	 = 0;
  	var totalGenders = 0;

	//196902193689926/insights/page_impressions_unique?since=1456732800&until=1457424000
  	FB.api('/' + id.toString() + '/insights/page_fans_gender_age?since=' + since.toString() + '&until=' + until.toString(), function(response){
  	 	$.each(response.data, function(i, item) {
  	 		$.each(item.values, function(j, item_2) {
  	 			$.each(item_2.value, function(k, item_3){
  	 				totalGenders+=item_3;
  	 				if(item_3 > valor) valor = item_3;
  	 				$.each(item_2.value, function(h, item_4){
  	 					if(valor < item_4){
  	 						valor = item_4;
  	 						genders = h;
  	 					}
  	 				});
  	 			});
  	 			
  	 		});
  	 		if(genders.substring(0,1) == 'F')
  	 			$("#gender_facebook").html("Women " + genders.substring(2,8));
  	 		else if(genders.substring(0,1) == 'M')
  	 			$("#gender_facebook").html("Men " + genders.substring(2,8));
  	 		else if(genders.substring(0,1) == 'U')
  	 			$("#gender_facebook").html("Undefined " + genders.substring(2,8));

  	 		valor = (valor*100)/totalGenders;

  	 		$("#subtext_facebook").html("Largest Audience " + new Intl.NumberFormat("es-MX").format(valor.toFixed(2)).toString() + " %");
		});
  	});
}

function fbPageViewsLoggedUnique(id){
	 var since   	 = mostrarFecha(-6);
  	var until   	 = mostrarFecha(1);

  	var www			 = 0;
  	var mobile		 = 0;
  	var other		 = 0;
  	var api 		 = 0;

  	var s_www		 = "";
  	var s_mobile	 = "";
  	var s_other		 = "";
  	var s_api		 = "";

  	var total 		 = 0;
  	var percent		 = 0;

	//196902193689926/insights/page_impressions_unique?since=1456732800&until=1457424000
  	FB.api('/' + id.toString() + '/insights/page_views_by_site_logged_in_unique/day?since=' + since.toString() + '&until=' + until.toString(), function(response){
  	 	$.each(response.data, function(i, item) {
  	 		$.each(item.values, function(j, item_2) {
  	 			$.each(item_2.value, function(k, item_3){
  	 				if(k == "WWW"){
  	 					s_www = "WWW";
  	 					www += item_3;
  	 				}else if(k == "MOBILE"){
  	 					s_mobile += "MOBILE";
  	 					mobile += item_3;
  	 				}else if(k == "OTHER"){
  	 					s_other += "OTHER";
  	 					other = item_3;
  	 				}else if(k == "API"){
  	 					s_api += "API";
  	 					api += item_3;
  	 				}
  	 			});
  	 		});
		});
  	 	total = www+mobile+other+api;
		//subtext_devices_facebook
		var mayor = 0;
		var s_text = "";
		s_text = "Most Common Device ";
		if(www > mobile && www > other && www > api){
			mayor = www;
		}
		if(mobile > www && mobile > other && mobile > api){
			mayor = mobile;
		}
		if(other > www && other > mobile && other > api){
			mayor = other;
		}
		if(api > www && api > other && api > mobile){
			mayor = api;
		}

		percent = (mayor*100)/total;
		if(isNaN(percent)) percent = 0;
		$("#subtext_devices_facebook").html(s_text + new Intl.NumberFormat("es-MX").format(percent.toFixed(2)).toString() + " %");

  	 });
}



  function fbGetManagedPages(){
  	 FB.api('/me/accounts?fields=id,name,category,description,picture', function(response){
  	 	$.each(response.data, function(i, item) {
    		var htmlPages = "<option selected=\"selected\" value='" + item.id + "'>" + item.name + "</option>";
        picture_page = item.picture;
    		$("#list_pages").append(htmlPages);
		  });
    });
    initGoogleCharts();
  }


  function writePostData(picture, name_post, likes, comments, shares, engagement, message, date_time){

    var html_posts =  "<div class=\"col-md-4\">";
        html_posts += "<div class=\"box box-widget widget-user\">";
        html_posts += "<div class=\"widget-user-header bg-black\" style=\"background: url('" + picture.toString() + "') ;\">";
          html_posts += "<h3 class=\"widget-user-username\"><b>" + name_post.toString().substring(0,15) + "...</b></h3>";
        html_posts += "</div>";
        html_posts += "<div class=\"box-footer no-padding\">";
        html_posts += "<ul class=\"nav nav-stacked\">";
        html_posts += "<li><a href=\"#\">Likes <span class=\"pull-right badge bg-blue\">" + likes.toString() + "</span></a></li>";
        html_posts += "<li><a href=\"#\">Comments <span class=\"pull-right badge bg-aqua\">" + comments.toString() + "</span></a></li>";
        html_posts += "<li><a href=\"#\">Shares <span class=\"pull-right badge bg-green\">" + shares.toString() + "</span></a></li>";
        html_posts += "<li><a href=\"#\">Engagement <span class=\"pull-right badge bg-red\">" + engagement.toString() + "</span></a></li>";
        html_posts += "</ul>";
        html_posts += "</div>";
        html_posts += "</div><!-- /.widget-user -->";
        html_posts += "</div><!-- /.col -->";


    var html_posts_2 =  "<div class=\"col-md-4\">";
        html_posts_2 += "<div class=\"box box-widget\">";
        html_posts_2 += "<div class='box-header with-border'>";
        html_posts_2 += "<div class='user-block'>";
        html_posts_2 += "<img class='img-circle' src='" + picture_page + "' alt='user image'>";
        html_posts_2 += "<span class='username'><a href=\"#\">" + name_page + "</a></span>";
        html_posts_2 += "<span class='description'>Shared publicly - " + date_time.toString() +"</span>";
        html_posts_2 += "</div><!-- /.user-block -->";
        html_posts_2 += "<div class='box-tools'>";
        
        html_posts_2 += "<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>";
        html_posts_2 += "<button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>";
        html_posts_2 += "</div><!-- /.box-tools -->";
        html_posts_2 += "</div><!-- /.box-header -->";
        html_posts_2 += "<div class='box-body'>";
        html_posts_2 += "<img class=\"img-responsive pad\" src=\"" + picture.toString() + "\" width='200px' heigth='200px' alt=\"Photo\">";
        html_posts_2 += "<p>" + message.substring(0,40) + "...</p>";
        html_posts_2 += "<button class='btn btn-default btn-xs'><i class='fa fa-share'></i> " + shares.toString() + " Shares</button>";
        html_posts_2 += "<button class='btn btn-default btn-xs'><i class='fa fa-thumbs-o-up'></i> " + likes.toString() + " Likes</button>";
        
        //html_posts_2 += "<span class='pull-right text-muted'>" + likes.toString() + " likes - " + comments.toString() + " comments - " + engagement.toString() + " engagement</span>";
        html_posts_2 += "</div><!-- /.box-body -->";
        html_posts_2 += "</div>";

      $("#ids_tops_posts").append(html_posts_2);
}

  
  function fbGetAllPosts(id){

    $("#ids_tops_posts").html("");

    var since        = mostrarFecha(-28);
    var until        = mostrarFecha(-1);
    
    var count        = 0;
    var count_photo  = 0;
    var count_video  = 0;
    var count_link   = 0;

    var count_domingo   = 0;
    var count_lunes     = 0;
    var count_martes    = 0;
    var count_miercoles = 0;
    var count_jueves    = 0;
    var count_viernes   = 0;
    var count_sabado    = 0;

    var series_photo = [];
    var series_video = [];
    var series_link  = [];

    var series       = [];
    var series_line  = [];
    var categories   = [];

    var data_impressions = 0;

    FB.api('/' + id.toString() + '/posts?limit=100&fields=id,type,picture,message,created_time,name&since=' + since.toString() + '&until=' + until.toString(), function(response){
      $.each(response.data, function(i, item) {
        
        if(count < 10){
          fbGetImpressionsUniqueByPost(item.id, function(resultado){
            fbGetDataByPost(item.id, item.picture, item.name, resultado, item.message, item.created_time);     
            //$("#ids_tops_posts").append(item.id+"<br>");     
          });
        }
          
        
        
        if(item.type == "photo")
          count_photo++;
        if(item.type == "video")
          count_video++;
        if(item.type == "link")
          count_link++;
        /*
          0 -> Domingo
          1 -> Lunes
          2 -> Martes
          3 -> Miercoles
          4 -> Jueves
          5 -> Viernes
          6 -> Sabado
        */
        var fecha = new Date(item.created_time);
        switch(fecha.getDay()){
          case 0:
            count_domingo++;
            break;
          case 1:
            count_lunes++;
            break;
          case 2:
            count_martes++;
            break;
          case 3:
            count_miercoles++;
            break;
          case 4:
            count_jueves++;
            break;
          case 5:
            count_viernes++;
            break;
          case 6:
            count_sabado++;
            break;

        }
        count++;
        //writePostData(picture, name_post, likes, comments, shares)
        //writePostData(item.picture, item_name, 10, 10, 10);
        
      });
      
      categories.push("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
      series_line.push({"name": "By Day", "data": [count_domingo, count_lunes, count_martes, count_miercoles, count_jueves, count_viernes, count_sabado]});
      //alert(JSON.stringify(series_line));
      series.push({"name":"photos", "data": [count_photo]});
      series.push({"name":"videos", "data": [count_video]});
      series.push({"name":"links", "data":  [count_link]});
      //alert(JSON.stringify(series));
      setGraphTypePosts(series, "Type by Posts", "www.proacit.com.mx", "Last 28 days ago");
      setGraphPostByDay(series_line, "Post by Week Day", "www.proacit.com.mx", categories);
      
      $("#total_posts_facebook").html(count.toString());
      $("#subtext_total_post").html(" Total Post in 28 days ago.");
      
    });
    
    
    //initGoogleCharts();
  }


  function fbGetImpressionsUniqueByPost(id, callback){
    var since        = mostrarFecha(-28);
    var until        = mostrarFecha(-1);    
    var impressions  = 0;    

    FB.api('/' + id.toString() + '/insights/post_impressions_unique/lifetime?limit=100&fields=name,period,values&since=' + since.toString() + '&until=' + until.toString(), function(response){
      $.each(response.data, function(i, item) {
        callback(item.values[i].value);
        //alert(item.values[i].value);
        //impressions = item.values[i].value;
      });
      
    });
  }

  
  
  function fbGetDataByPost(id, picture, name, impressions, message, date_time){

    var since        = mostrarFecha(-28);
    var until        = mostrarFecha(-1);

    var likes = 0;
    var comments = 0;
    var shares = 0;

    var engagement = 0;
    //alert('/' + id.toString() + '/insights/post_story_adds_by_action_type/lifetime?fields=name,period,values,title,id&since=' + since.toString() + '&until=' + until.toString());
    FB.api('/' + id.toString() + '/insights/post_story_adds_by_action_type/lifetime?limit=100&fields=picture,name,period,values,title,id&since=' + since.toString() + '&until=' + until.toString(), function(response){
      $.each(response.data, function(i, item) {
        $.each(item.values, function(j, item_1) {
          likes = item_1.value.like;
          comments = item_1.value.comment;
          shares = item_1.value.share;
          //$("#ids_tops_posts").append(JSON.stringify(shares));
        });
        //alert(JSON.stringify(item));
        //writePostData(picture, name, likes, comments, shares);
        if(likes == null)
          likes = 0;
        if(comments == null)
          comments = 0;
        if(shares == null)
          shares = 0;

        engagement = ((likes+comments+shares)/impressions)*100;
        engagement = new Intl.NumberFormat("es-MX").format(engagement.toFixed(2)).toString();

        series_posts.push({"id": id, "likes": [likes], "comments": [comments], "shares": [shares], "engagement":[engagement]});
        writePostData(picture, name, likes, comments, shares, engagement, message, date_time);
        //$("#ids_tops_posts").append("<br>Picture: " + picture.toString() + ", Name: " + name.toString() + ", Like: " + likes.toString() + ", Comments: " + comments + "</br>");
      });
      
    });
    //writePostData(item.picture, item.name, 10, 10, 10);
  }

  function mostrarFecha(days){
    milisegundos=parseInt(35*24*60*60*1000);
 
    fecha=new Date();
    day=fecha.getDate();
    // el mes es devuelto entre 0 y 11
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
 
    //document.write("Fecha actual: "+day+"/"+month+"/"+year);
 
    //Obtenemos los milisegundos desde media noche del 1/1/1970
    tiempo=fecha.getTime();
    //Calculamos los milisegundos sobre la fecha que hay que sumar o restar...
    milisegundos=parseInt(days*24*60*60*1000);
    //Modificamos la fecha actual
    total=fecha.setTime(tiempo+milisegundos);
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();

    var dateAnt = new Date(year+"/"+month+"/"+day+" 08:00:00");
    var dateSpochAnt = (dateAnt.getTime()-dateAnt.getMilliseconds())/1000;
     
    return dateSpochAnt;
}

function initGoogleCharts(){
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
}

function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


 $('#click_instagram').click(function(){
    window.location.href = "https://api.instagram.com/oauth/authorize/?client_id=d111e1472bec4663b76b0251814cd9a8&redirect_uri=https://localhost/smartmetrix/pages/settings.php?type=instagram&response_type=code&scope=basic+relationships+likes+comments+follower_list+public_content";
  });
$('#click_pinterest').click(function(){
    window.location.href = "https://api.pinterest.com/oauth/?response_type=token&client_id=4820387715925165421&scope=read_public&redirect_uri=https://localhost/smartmetrix/pages/settings.php?type=pinterest";
});


 	  