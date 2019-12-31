<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>安全资产管理系统 - 首页</title>
  <meta name = "keywords" content = "security,property,management,soc,mis" />
  <meta name = "description" content = "上海分部安全资产管理系统" />
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
	    RAW TABLE: 
	    <li><a id = "role" href = "#">ROLE</a> | </li>
	    <li><a id = "team" href = "#">TEAM</a> | </li>
	    <li><a id = "dept" href = "#">DEPT</a> | </li>
	    <li><a id = "idc" href = "#">IDC</a> | </li>
  	    <li><a id = "itsys" href = "#">IT SY</a> | </li>
	    <li><a id = "ip" href = "#">IP ADDR</a> | </li>
	    <li><a id = "iptype" href = "#">IP TYPE</a></li>
      </ul>
	  <ul>
	    STATIC VIEW: 
	    <li><a id = "dept_role_team" href = "#">运营室安全责任人</a> | </li>
	    <li><a id = "idc_team" href = "#">机房安全责任人</a> | </li>
	    <li><a id = "itsys_team" href = "#">IT系统安全责任人</a></li>
	  </ul>
	  <ul>
	    DYNAMIC VIEW: 
	    <li><a href = "itsys_ip.php" target = "_blank">IT SY & IP ADDR</a> | </li>
	    <li><a href = "ip_iptype.php" target = "_blank">IP ADDR & TYPE</a></li>
	  </ul>
	  <hr />
	</div>
    <div id = "bodycontent">
	  <div id = "role">
	    <?php $result = $conn->query("SELECT role.id, role.name, role.desc FROM role ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
          <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td>".$row["desc"]."</td><td><a href = 'edit_role.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "team">
	    <?php $result = $conn->query("SELECT team.id, team.name, team.mphone, team.email, team.desc FROM team ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td>".$row["mphone"]."</td><td>".$row["email"]."</td><td>".$row["desc"]."</td><td><a href = 'edit_team.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	  <hr />
	  </div>
	  <div id = "dept">
	    <?php $result = $conn->query("SELECT dept.id, dept.name, dept.desc FROM dept ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td class = 'lt450'>".$row["desc"]."</td><td><a href = 'edit_dept.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "idc">
	    <?php $result = $conn->query("SELECT idc.id, idc.name, idc.desc FROM idc ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td>".$row["desc"]."</td><td><a href = 'edit_idc.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "itsys">
	    <?php $result = $conn->query("SELECT itsys.id, itsys.name, itsys.weight, itsys.desc FROM itsys ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>IMPORTANCE</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php
		    while($row = $result->fetchArray()) {
			  $weight = "";
			  for($i = 0; $i < $row["weight"]; $i ++)$weight.="★";
			  echo "<tr><td>".$row["name"]."</td><td>".$weight."</td><td>".$row["desc"]."</td><td><a href = 'edit_itsys.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>";
		    }
		  ?>
		</table>
	    <hr />
	  </div>
	  <div id = "ip">
	    <?php $result = $conn->query("SELECT ip.id, ip.name, ip.desc FROM ip ORDER BY name"); ?>
	    <table>
		  <tr><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td>".$row["desc"]."</td><td><a href = 'edit_ip.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "iptype">
	    <?php $result = $conn->query("SELECT iptype.id, iptype.name, iptype.desc FROM iptype ORDER BY id"); ?>
	    <table>
		  <tr><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["name"]."</td><td>".$row["desc"]."</td><td><a href = 'edit_iptype.php?id=".$row["id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "dept_role_team">
	    <?php $result = $conn->query("SELECT dept_role_team.id AS dept_role_team_id, dept.name AS dept_name, role.name AS role_name, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email, dept_role_team.desc AS dept_role_team_desc FROM dept_role_team, dept_role, team, dept, role WHERE dept_role_team.team_id = team.id AND dept_role_team.dept_role_id = dept_role.id AND dept_role.dept_id = dept.id AND dept_role.role_id = role.id ORDER BY dept.name, role.name"); ?>
	    <table>
		  <tr><th>DEPT_NAME</th><th>ROLE_NAME</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["dept_name"]."</td><td>".$row["role_name"]."</td><td>".$row["team_name"]."</td><td>".$row["team_mphone"]."</td><td>".$row["team_email"]."</td><td>".$row["dept_role_team_desc"]."</td><td><a href = 'edit_dept_role_team.php?id=".$row["dept_role_team_id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "idc_team">
	    <?php $result = $conn->query("SELECT idc_team.id AS idc_team_id, idc.name AS idc_name, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email, idc_team.desc AS idc_team_desc FROM idc_team, idc, team WHERE idc_team.idc_id = idc.id AND idc_team.team_id = team.id ORDER BY idc.name"); ?>
	    <table>
		  <tr><th>IDC_NAME</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["idc_name"]."</td><td>".$row["team_name"]."</td><td>".$row["team_mphone"]."</td><td>".$row["team_email"]."</td><td>".$row["idc_team_desc"]."</td><td><a href = 'edit_idc_team.php?id=".$row["idc_team_id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <div id = "itsys_team">
	    <?php $result = $conn->query("SELECT itsys.weight AS itsys_weight, itsys_team.id AS itsys_team_id, itsys.name AS itsys_name, team.name AS team_name, team.mphone AS team_mphone, team.email AS team_email, itsys_team.desc AS itsys_team_desc FROM itsys_team, itsys, team WHERE itsys_team.itsys_id = itsys.id AND itsys_team.team_id = team.id"); ?>
	    <table>
		  <tr><th>ITSYS_NAME</th><th>ITSYS_WEIGHT</th><th>TEAM_NAME</th><th>CELLPHONE</th><th>E-MAIL</th><th>DESCRIPTION</th><th>ACTION</th></tr>
	      <?php while($row = $result->fetchArray())echo "<tr><td>".$row["itsys_name"]."</td><td>".$row["itsys_weight"]."</td><td>".$row["team_name"]."</td><td>".$row["team_mphone"]."</td><td>".$row["team_email"]."</td><td>".$row["itsys_team_desc"]."</td><td><a href = 'edit_itsys_team.php?id=".$row["itsys_team_id"]."' target = '_blank'>EDIT</a></td></tr>"; ?>
		</table>
	    <hr />
	  </div>
	  <?php $conn->close(); ?>
	</div>
	<div id = "footer">
	  <p>@2016 中国电信股份有限公司上海企业信息化运营中心<br>
	  基础设施室安全和网络组</p>
	</div>
  </div>
</body>
</html>