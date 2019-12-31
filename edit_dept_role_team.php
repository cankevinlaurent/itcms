<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>编辑 - 运营室安全责任人</title>
  <meta name = "keywords" content = "department, in charge of, edit" />
  <meta name = "description" content = "编辑运营室安全责任人" />
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
	<div id = "nav"></div>
	<div id = "bodycontent">
	  <div>
	    <form action = "" method = "get">
	      <table>
		    <tr><th>DEPT_ROLE_TEAM_ID</th><th>DEPT_NAME</th><th>ROLE_NAME</th><th>TEAM_NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
			<tr>
			  <?php
		        $index_id = trim($_GET["id"]);
				$new_team_id = trim($_GET["new_team_id"]);
			    $new_desc = trim($_GET["new_desc"]);
			    if($index_id && $new_team_id){
			      $result = $conn->exec("UPDATE dept_role_team SET team_id = '".$new_team_id."', desc = '".$new_desc."' WHERE id = ".$index_id);
			      if($conn->changes())echo "<p>UPDATE SUCCESSFULLY</p>";
				  else echo "<p>FAILED</p>";
			    }
		        $result = $conn->query("SELECT dept_role_team.id AS dept_role_team_id, dept_role_team.desc AS dept_role_team_desc, dept.name AS dept_name, role.name AS role_name, team.name AS team_name, team.id AS team_id FROM dept_role_team, dept_role, team, dept, role WHERE dept_role_team.team_id = team.id AND dept_role_team.dept_role_id = dept_role.id AND dept_role.dept_id = dept.id AND dept_role.role_id = role.id AND dept_role_team.id = ".$index_id);
			    $row = $result->fetchArray();
              ?>
			  <td><?php echo $row["dept_role_team_id"]; ?><input type = "hidden" name = "id" value = "<?php echo $row["dept_role_team_id"]; ?>" /></td>
			  <td><?php echo $row["dept_name"]; ?></td>
			  <td><?php echo $row["role_name"]; ?></td>
			  <td>
			    <select class = "white" name = "new_team_id">
				  <?php
	                $result_team_id = $conn->query("SELECT id, name FROM team ORDER BY id");
		            while($row_team_id = $result_team_id->fetchArray()){
				      if($row["team_id"] == $row_team_id["id"])echo "<option class = 'white' selected = 'selected' value = '".$row_team_id["id"]."'>".$row_team_id["name"]."</option>";
					  else echo "<option class = 'white' value = '".$row_team_id["id"]."'>".$row_team_id["name"]."</option>";
					}
	              ?>
				</select>
		      </td>
			  <td><input type = "text" class = "white" name = "new_desc" value = "<?php echo $row["dept_role_team_desc"]; ?>" /></td>
			  <td><a href = "<?php echo $_SERVER["SCRIPT_NAME"]."?id=".$row["dept_role_team_id"]; ?>">CANCEL</a><span class = "darkgolden"> OR </span><a id = "edit_submit" href = "#">SUBMIT</a></td>
			</tr>
		  </table>
		</form>
      </div>
	  <hr />
	</div>
    <div id = "footer">
	  <p>@2016 中国电信股份有限公司上海企业信息化运营中心<br>
	  基础设施室安全和网络组</p>
    </div>
  </div>
</body>
</html>