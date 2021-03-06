<?php
SESSION_START();
if (isset($_SESSION["identifiantEtudiant"]) && isset($_SESSION["motdepasseEtudiant"])){

?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Choix option</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>
	
  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <div id="exist" style="display: none;">
<?php $bdd = new PDO('mysql:host=localhost;dbname=projetm1','root','');
												$reponse = $bdd->prepare('SELECT * FROM `choix_etudiant` WHERE `ine` = :ine ');
												$reponse->execute(array(
												'ine' => $_SESSION["identifiantEtudiant"] 
												));
												$exist = $reponse->rowCount();
												echo htmlspecialchars($exist);
			?>
             
</div>
      <div id="option_valide" style="display: none;">
<?php $bdd = new PDO('mysql:host=localhost;dbname=projetm1','root','');
                        $reponse = $bdd->prepare('select id_option from options as O , etudiants AS E where E.ine = :ine and O.id_option = E.option_valide');
                        $reponse->execute(array(
                        'ine' => $_SESSION["identifiantEtudiant"] 
                        ));
                        $option_valide = $reponse-> fetchColumn();
       ?>          
</div>

        <div id="nb-options" style="display: none;">
<?php $bdd = new PDO('mysql:host=localhost;dbname=projetm1','root','');
												$reponse = $bdd->prepare('select nom,id_option from options where id_option <> :opt_valide');
                        $reponse->execute(array(
                        'opt_valide' => $option_valide
                        ));
												$count = $reponse->rowCount();
												echo htmlspecialchars($count);
			?>
             
</div>



<script language="JavaScript" type="text/javascript">
function recupVal(id){
    var txtNombre = ""+id;
        
    var elt = txtNombre.split('.'); 
    var ligne = elt[0];
    var col = elt[1];
    hidden_vertical(ligne,col);
    
	  hidden_drop(ligne);

		
    var Selection = new Array();
    
    if (col = 1){
      for (var colonne = 0; colonne < 3 ; colonne++) {
        var col_suiv = Number(col)+Number(colonne);
      
      var ListeOption = document.getElementById('liste_op'+ligne+'.'+col_suiv);
      var l = ListeOption.options.length;
      var suiv = Number(ligne) + Number(1);
      var elSelSuiv = document.getElementById('liste_op'+suiv+'.'+col_suiv); 
      elSelSuiv.innerHTML = ''; 
        for(var i = 0 ;i< l;i++ ){
          //if(ListeOption.options[i].selected ){
          //  Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
          //}
          //else
           if(!ListeOption.options[i].selected && !false){
            Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
            var oOption = document.createElement('option');
            oOption.value = ListeOption.options[i].value;
            oOption.text = ListeOption.options[i].text;
            elSelSuiv.add(oOption);
          }
          }
    }
    } else if (col = 2){
      var col_avant = Number(col) - Number(1);
      var ListeOption = document.getElementById('liste_op'+ligne+'.'+col_avant);
      var l = ListeOption.options.length;
      var suiv = Number(ligne) + Number(1);
      var elSelSuiv = document.getElementById('liste_op'+suiv+'.'+col_avant); 
       for(var i = 0 ;i< l;i++ ){
           if(!ListeOption.options[i].selected && !false){
            Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
            var oOption = document.createElement('option');
            oOption.value = ListeOption.options[i].value;
            oOption.text = ListeOption.options[i].text;
            elSelSuiv.add(oOption);
          }
          }
      for (var colonne = 1; colonne < 3 ; colonne++) {
        var col_suiv = Number(col)+Number(colonne);
      var ListeOption = document.getElementById('liste_op'+ligne+'.'+col_suiv);
      var l = ListeOption.options.length;
      var suiv = Number(ligne) + Number(1);
      var elSelSuiv = document.getElementById('liste_op'+suiv+'.'+col_suiv); 
        for(var i = 0 ;i< l;i++ ){
          //if(ListeOption.options[i].selected ){
          //  Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
          //}
          //else
           if(!ListeOption.options[i].selected && !false){
            Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
            var oOption = document.createElement('option');
            oOption.value = ListeOption.options[i].value;
            oOption.text = ListeOption.options[i].text;
            elSelSuiv.add(oOption);
          }
          }
        }
    }else if ( col = 3 ){
      for (var colonne = 1; colonne < 3 ; colonne++) {
        var col_suiv = Number(col)- Number(colonne);
      var ListeOption = document.getElementById('liste_op'+ligne+'.'+col_suiv);
      var l = ListeOption.options.length;
      var suiv = Number(ligne) + Number(1);
      var elSelSuiv = document.getElementById('liste_op'+suiv+'.'+col_suiv); 
        for(var i = 0 ;i< l;i++ ){
          //if(ListeOption.options[i].selected ){
          //  Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
          //}
          //else
           if(!ListeOption.options[i].selected && !false){
            Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
            var oOption = document.createElement('option');
            oOption.value = ListeOption.options[i].value;
            oOption.text = ListeOption.options[i].text;
            elSelSuiv.add(oOption);
          }
          }
        }
        var col_avant = Number(col) ;
      var ListeOption = document.getElementById('liste_op'+ligne+'.'+col_avant);
      var l = ListeOption.options.length;
      var suiv = Number(ligne) + Number(1);
      var elSelSuiv = document.getElementById('liste_op'+suiv+'.'+col_avant); 
       for(var i = 0 ;i< l;i++ ){
           if(!ListeOption.options[i].selected && !false){
            Selection.push(ListeOption.options[i].value,ListeOption.options[i].text);
            var oOption = document.createElement('option');
            oOption.value = ListeOption.options[i].value;
            oOption.text = ListeOption.options[i].text;
            elSelSuiv.add(oOption);
          }
          }
    } 
	}
</script>

<script language="JavaScript" type="text/javascript">
function hidden_drop(id){
    var next = Number(id) + Number(1);	
		var div = document.getElementById("nb-options");
    	var nboption = div.textContent;	

		for(var j = 1 ;j<= 3;j++ ){
      document.getElementById('liste_op'+next+'.'+j).selectedIndex = "-1";
      document.getElementById('liste_op'+next+'.'+j).style.visibility='visible';
      } 
    //document.getElementById('liste_op'+(next-1)).style.visibility='visible';
    for(var i = next + 1 ;i<= nboption;i++ ){
		for(var j = 1 ;j<= 3;j++ ){
			document.getElementById('liste_op'+i+'.'+j).style.visibility='hidden';
      document.getElementById('liste_op'+i+'.'+j).selectedIndex = "-1";
    }   
		}		
		
	}
</script>
<script type="text/javascript" language="javascript" >
  function hidden_vertical(id,col){
            var val =document.getElementById("liste_op"+id+'.'+col).value;

            if (val == -1) {
                  document.getElementById('liste_op'+id+'.1').style.visibility='visible';
                  document.getElementById('liste_op'+id+'.2').style.visibility='visible';
                  document.getElementById('liste_op'+id+'.3').style.visibility='visible';
                  document.getElementById('liste_op'+id+'.1').selectedIndex = "-1";
                  document.getElementById('liste_op'+id+'.2').selectedIndex = "-1";
                  document.getElementById('liste_op'+id+'.3').selectedIndex = "-1";
            }else {
                if ( col == 1){                 
                      document.getElementById('liste_op'+id+'.1').style.visibility='visible';
                      document.getElementById('liste_op'+id+'.2').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.3').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.2').selectedIndex = "-1";
                      document.getElementById('liste_op'+id+'.3').selectedIndex = "-1";
              }else  if ( col == 2){        
                      document.getElementById('liste_op'+id+'.1').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.2').style.visibility='visible';
                      document.getElementById('liste_op'+id+'.3').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.1').selectedIndex = "-1";
                      document.getElementById('liste_op'+id+'.3').selectedIndex = "-1";
              }else if ( col == 3){
                      document.getElementById('liste_op'+id+'.1').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.2').style.visibility='hidden';
                      document.getElementById('liste_op'+id+'.1').selectedIndex = "-1";
                      document.getElementById('liste_op'+id+'.2').selectedIndex = "-1";
                      document.getElementById('liste_op'+id+'.3').style.visibility='visible';
              }
            }
          
  }

</script>
<script language="JavaScript" type="text/javascript">
function verif_ins(){
	var div = document.getElementById("exist");
    	var exist = div.textContent;	
  if(exist == 0){
  return true;
  }else{
  alert('choix déja effectueé');
     return false;
  
  }
}
</script>

</head>

<body class="nav-md" onload="hidden_drop(0)">

	<div class="container body">
	
		<div class="main_container">
			 <form action="choix-option.php" method="POST">
          <div class="col-md-3 left_col">
       
				<div class="left_col scroll-view">

					<div class="navbar nav_title" style="border: 0;">
						<a href="accueil.php" class="site_title"><i class="fa fa-paw"></i> <span>OptionChoice</span></a>
					</div>
					<div class="clearfix"></div>

					  <!-- menu prile quick info -->
					<div class="profile_pic">
						<img src="images/user.png" alt="..." class="img-circle profile_img">
					</div>
					<div class="profile">
						<div class="profile_info">
						  <span>Welcome,</span>
						   <?php
			              echo "<h2>cher(e) :".$_SESSION["identifiantEtudiant"]."</h2>";
						  print ("<input type='hidden' name='num' value=".$_SESSION["identifiantEtudiant"].">");
			              ?>
						</div>
					</div>
					  <!-- /menu prile quick info -->

					<div class="clearfix"></div>

				  <!-- sidebar menu -->
				  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

					<div class="menu_section">
					  <h3>General</h3>
					  <ul class="nav side-menu">
						<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
						</li>
                      
                         <li><a><i class="fa fa-check-circle"></i> Choix <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu" style="display: none">
								<li><a href="mes-choix.php">Mes Choix</a>
								</li>
								</ul>
						</li>
					  </ul>
					</div>
					
				  </div>
				  <!-- /sidebar menu -->

				</div>
			</div>
			
			<!-- top navigation -->
			<div class="top_nav">

				<div class="nav_menu">
					<nav class="" role="navigation">
						<div class="nav toggle">
						  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
						  <li class="">
							<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							  Monsieur test
							  <span class=" fa fa-angle-down"></span>
							</a>
							<ul class="dropdown-menu dropdown-usermenu pull-right">
							  <li><?php echo "<a href=\"destroy.php\" ><i class=\"fa fa-sign-out pull-right\"></i> Déconnexion </a>"; ?>
							  </li>
							</ul>
						  </li>
						</ul>
					</nav>
				</div>

			</div>
			<!-- /top navigation -->
			
			<!-- corps -->
			<div class="right_col" role="main">
			<div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Choix option<small>L3</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                  <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="#">Settings 1</a>
                                      </li>
                                      <li><a href="#">Settings 2</a>
                                      </li>
                                    </ul>
                                  </li>
                                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                                  </li>
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="x_content">

                                <table class="table table-bordered">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Option</th>
                                      <th>Option Jeudi</th>
                                      <th>Option Vendredi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
<?php
                      if ($option_valide == '') $option_valide = '" "';

                      try
                      {
                        print ("<input type='hidden' name='nb' value=".$count.">");
                        $i=1;
                        while ($i<= $count){ 

                        print ("<tr><th scope='row'><label id='label_".$i."'>$i </label></th>");
                        $j=1;                        
                        print ('<td><select id="liste_op'.$i.'.'.$j.'" name="liste_op'.$i.'.'.$j.'" class="form-control" onChange="recupVal('.$i.'.'.$j.')" >');
                        $repons = $bdd->query('select nom,id_option from options WHERE `numero_option` = "" and id_option <> '.$option_valide);
                        echo'<option value="-1" selected="selected"> </option>';
                        while($donne = $repons->fetch()){
                          echo"<option value='$donne[id_option]'>$donne[nom]</option>"; 
                          
                        }print ("</select></td>");
                        $j++;
                        print ('<td><select id="liste_op'.$i.'.'.$j.'" name="liste_op'.$i.'.'.$j.'" class="form-control" onChange="recupVal('.$i.'.'.$j.')" >');
                        $repons = $bdd->query('select nom,id_option from options WHERE `numero_option` = 1 and id_option <> '.$option_valide.';');
                        echo'<option value="-1" selected="selected"> </option>';
                        while($donne = $repons->fetch()){
                          echo"<option value='$donne[id_option]'>$donne[nom]</option>"; 
                          
                        }print ("</select></td>");
                        $j++;
                        print ('<td><select id="liste_op'.$i.'.'.$j.'" name="liste_op'.$i.'.'.$j.'" class="form-control" onChange="recupVal('.$i.'.'.$j.')" >');
                        $repons = $bdd->query('select nom,id_option from options WHERE `numero_option` = 2  and id_option <> '.$option_valide.';');
                        echo'<option value="-1" selected="selected"> </option>';
                        while($donne = $repons->fetch()){
                          echo"<option value='$donne[id_option]'>$donne[nom]</option>"; 
                          
                        }print ("</select></td></tr>");
                        $i++;
                        }
                         
                      }
                      catch (Exception $e)
                      {
                        die('Erreur : ' . $e->getMessage());
                      }
                    ?>
                    <tr><td colspan="4"><center><button type="submit" class="btn btn-default btn-success submit" onClick="return verif_ins()">OK</button><button type="reset" class="btn btn-default btn-info">Reset</button></center></td></tr>
                                  </tbody>
                                </table>

                              </div>
                            </div>
                          </div>
            </div>
            

            </div>
           </form>

			<!-- /corps -->
		</div>
	</div>
	
	<script src="js/bootstrap.min.js"></script>

  <!-- gauge js -->
  <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script>
 
 
  <script>
    $(document).ready(function() {
      // [17, 74, 6, 39, 20, 85, 7]
      //[82, 23, 66, 9, 99, 6, 2]
      var data1 = [
        [gd(2012, 1, 1), 17],
        [gd(2012, 1, 2), 74],
        [gd(2012, 1, 3), 6],
        [gd(2012, 1, 4), 39],
        [gd(2012, 1, 5), 20],
        [gd(2012, 1, 6), 85],
        [gd(2012, 1, 7), 7]
      ];

      var data2 = [
        [gd(2012, 1, 1), 82],
        [gd(2012, 1, 2), 23],
        [gd(2012, 1, 3), 66],
        [gd(2012, 1, 4), 9],
        [gd(2012, 1, 5), 119],
        [gd(2012, 1, 6), 6],
        [gd(2012, 1, 7), 9]
      ];
      $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
        data1, data2
      ], {
        series: {
          lines: {
            show: false,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 0,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          //tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
            //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
        },
        yaxis: {
          ticks: 8,
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: false
      });

      function gd(year, month, day) {
        return new Date(year, month - 1, day).getTime();
      }
    });


</script>

  <!-- worldmap -->
  <script type="text/javascript" src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(function() {
      $('#world-map-gdp').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        series: {
          regions: [{
            values: gdpData,
            scale: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
          }]
        },
        onRegionTipShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script>
  <!-- skycons -->
  <script src="js/skycons/skycons.min.js"></script>
  <script>
    var icons = new Skycons({
        "color": "#73879C"
      }),
      list = [
        "clear-day", "clear-night", "partly-cloudy-day",
        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
        "fog"
      ],
      i;

    for (i = list.length; i--;)
      icons.set(list[i], list[i]);

    icons.play();
  </script>

  <!-- dashbord linegraph -->
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    var data = {
      labels: [
        "Symbian",
        "Blackberry",
        "Other",
        "Android",
        "IOS"
      ],
      datasets: [{
        data: [15, 20, 30, 10, 30],
        backgroundColor: [
          "#BDC3C7",
          "#9B59B6",
          "#455C73",
          "#26B99A",
          "#3498DB"
        ],
        hoverBackgroundColor: [
          "#CFD4D8",
          "#B370CF",
          "#34495E",
          "#36CAAB",
          "#49A9EA"
        ]

      }]
    };

    var canvasDoughnut = new Chart(document.getElementById("canvas1"), {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: data
    });
  </script>
  <!-- /dashbord linegraph -->
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <script>
    NProgress.done();
  </script>
	 
	
</body>
<?php
}
else {
header("location:login.php?msg=0");
}
?>
</html>