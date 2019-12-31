<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>IT系统和IP表</title>
  <meta name = "keywords" content = "it system, ip address, relationship" />
  <meta name = "description" content = "IT系统和IP表" />
  <meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8" />
  <meta http-equiv = "X-UA-Compatible" content = "IE = edge" />
  <link type = "text/css" href = "elements/diablo.css" rel = "stylesheet" />
  <script type="text/javascript" src = "elements/jquery-2.2.0.min.js"></script>
  <script type = "text/javascript" src = "elements/myscript.js"></script>
</head>
<body>
  <div id = "container">
    <div id = "header">
	  <div id = "connector">
        <?php
          $para = parse_ini_file("elements/config.ini");
          $conn = new SQLite3($para["dbname"]);
          if(!$conn) echo "DATABASE: [ <span class = 'red'>FAILED</span> ]";
          else echo "DATABASE: [ <span class = 'green'>READY</span> ]";
        ?>
      </div>
	  <hr />
	</div>
	<div id = "nav">
	  <ul>
		STATIC VIEW: 
		<li><a id = "itsys_ip" href = "#">IT系统和IP表</a></li>
      </ul>
      <hr />
	</div>
    <div id = "search">
      <form action = "" method = "post">
        <p>IT SYSTEM SEARCH I: <input name = "search_ip" type = "text" class = "white" placeholder = "PLS INPUT IP ADDRESS" /><input type = "submit" value = "SEARCH" /></p>
		<p>IT SYSTEM SEARCH II:<select class = "white" name = "search_sys">
	    <?php
	      $result_sys = $conn->query("SELECT id, name FROM itsys ORDER BY name");
		  while($row_sys = $result_sys->fetchArray())echo "<option class = 'white' value = '".$row_sys["id"]."'>".$row_sys["name"]."</option>";
	    ?>
		</select><input type = "submit" value = "SEARCH" /></p>
	  </form>
    <hr />
    </div>
	<div id = "insert">
	  <form action = "" method = "post">
	    <p>INSERT A RECORD: <input name = "insert_ip" type = "text" class = "white" placeholder = "PLS INPUT IP ADDRESS" /><select class = "white" name = "insert_sys">
		<?php
	      $result = $conn->query("SELECT id, name FROM itsys ORDER BY name");
		  while($row = $result->fetchArray())echo "<option class = 'white' value = '".$row["id"]."'>".$row["name"]."</option>";
	    ?>
		</select><input name = "insert_desc" type = "text" class = "white" placeholder = "INPUT DESCRIPTION" /><input type = "submit" value = "INSERT" /></p>
	  </form>
	  <hr />
	</div>
	<div id = "bodycontent">
	  <div id = "itsys_ip">
	    <table>
		  <tr><th>ITSYS_NAME</th><th>IP_NAME</th><th>DESCRIPTION</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>ACTION</th></tr>
		  <?php
		    $result = $conn->query("SELECT itsys_ip.id AS itsys_ip_id, itsys.name AS itsys_name, ip.name AS ip_name, itsys_ip.desc AS itsys_ip_desc, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email FROM ip, itsys, itsys_ip, itsys_team, team WHERE itsys_ip.itsys_id = itsys.id AND itsys_ip.ip_id = ip.id AND itsys_team.itsys_id = itsys_ip.itsys_id AND itsys_team.team_id = team.id ORDER BY itsys.name, ip.name");
		    while($row = $result->fetchArray())echo "<tr><td>".$row["itsys_name"]."</td><td>".$row["ip_name"]."</td><td>".$row["itsys_ip_desc"]."</td><td>".$row["team_name"]."</td><td>".$row["team_mphone"]."</td><td>".$row["team_email"]."</td><td><a href = 'edit_itsys_ip.php?id=".$row["itsys_ip_id"]."' target = '_blank'>EDIT</a></td></tr>";
	      ?>
		</table>
		<hr />
      </div>
	  <div id = "itsys_ip_search_ip">
	    <table>
		  <tr><th>IP_NAME</th><th>ITSYS_NAME</th><th>DESCRIPTION</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>ACTION</th></tr>
	      <?php
		    $trimmed_search_ip = trim($_POST["search_ip"]);
		    if($trimmed_search_ip){
	          $result_search_ip = $conn->query("SELECT itsys_ip.id AS itsys_ip_id, ip.name AS ip_name, itsys.name AS itsys_name, itsys_ip.desc AS itsys_ip_desc, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email FROM ip, itsys, itsys_ip, itsys_team, team WHERE ip.name = '".$trimmed_search_ip."' AND ip.id = itsys_ip.ip_id AND itsys_ip.itsys_id = itsys.id AND itsys_ip.itsys_id = itsys_team.itsys_id AND itsys_team.team_id = team.id ORDER BY itsys.name");
	  	      while($row_search_ip = $result_search_ip->fetchArray())echo "<tr><td>".$row_search_ip["ip_name"]."</td><td>".$row_search_ip["itsys_name"]."</td><td>".$row_search_ip["itsys_ip_desc"]."</td><td>".$row_search_ip["team_name"]."</td><td>".$row_search_ip["team_mphone"]."</td><td>".$row_search_ip["team_email"]."</td><td><a href = 'edit_itsys_ip.php?id=".$row_search_ip["itsys_ip_id"]."' target = '_blank'>EDIT</a></td></tr>";
			  echo "<script type = 'text/javascript'>$('div#itsys_ip_search_ip').show();</script>";
		    }
	      ?>
		</table>
		<hr />
      </div>
	  <div id = "itsys_ip_search_sys">
	    <table>
		  <tr><th>ITSYS_NAME</th><th>IP_NAME</th><th>DESCRIPTION</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>ACTION</th></tr>
	      <?php
		    $trimmed_search_sys = trim($_POST["search_sys"]);
		    if($trimmed_search_sys){
	          $result_search_sys = $conn->query("SELECT itsys_ip.id AS itsys_ip_id, itsys.name AS itsys_name, ip.name AS ip_name, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email, itsys_ip.desc AS itsys_ip_desc FROM ip, itsys, itsys_ip, itsys_team, team WHERE itsys.id = '".$trimmed_search_sys."' AND itsys.id = itsys_ip.itsys_id AND itsys_ip.ip_id = ip.id AND itsys_ip.itsys_id = itsys_team.itsys_id AND itsys_team.team_id = team.id ORDER BY ip.name");
		      while($row_search_sys = $result_search_sys->fetchArray())echo "<tr><td>".$row_search_sys["itsys_name"]."</td><td>".$row_search_sys["ip_name"]."</td><td>".$row_search_sys["itsys_ip_desc"]."</td><td>".$row_search_sys["team_name"]."</td><td>".$row_search_sys["team_mphone"]."</td><td>".$row_search_sys["team_email"]."</td><td><a href = 'edit_itsys_ip.php?id=".$row_search_sys["itsys_ip_id"]."' target = '_blank'>EDIT</a></td></tr>";
			  echo "<script language = 'javascript'>$('div#itsys_ip_search_sys').show();</script>";
		    }
	      ?>
		</table>
		<hr />
      </div>
	  <div = id = "itsys_ip_insert">
	    <?php
		  $trimmed_insert_sys = trim($_POST["insert_sys"]);
		  $trimmed_insert_ip = trim($_POST["insert_ip"]);
		  $trimmed_insert_desc = trim($_POST["insert_desc"]);
		  if($trimmed_insert_ip){
	        $result = $conn->query("SELECT itsys.id AS itsys_id, ip.id AS ip_id FROM ip, itsys WHERE itsys.id = '".$trimmed_insert_sys."' AND ip.name = '".$trimmed_insert_ip."'");
		    $row = $result->fetchArray();
		    $req = $conn->exec("INSERT INTO itsys_ip (itsys_id, ip_id, `desc`) VALUES (".$row["itsys_id"].", ".$row["ip_id"].", '".$trimmed_insert_desc."')");
		    if($conn->changes())echo "<p>INSERTION COMPLETE.</p>";
		    else echo "<p>FAILED: DUPLICATED RECORD OR IP ADDRESS DOES NOT EXIST.</p>";
			echo "<script type = 'text/javascript'>$('div#itsys_ip_insert').show();</script>";
		  }
	    ?>
		<hr />
      </div>
	</div>
    <div id = "footer">
	  <p>@2016 中国电信股份有限公司上海企业信息化运营中心<br>
	  基础设施室网络和安全组</p>
    </div>
  </div>
</body>
</html>