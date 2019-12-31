<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>编辑 - IT系统和IP表</title>
  <meta name = "keywords" content = "it system, ip address, edit" />
  <meta name = "description" content = "编辑IT系统和IP表" />
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
		    <tr><th>ITSYS_IP_ID</th><th>IP_NAME</th><th>ITSYS_NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
			<tr>
			  <?php
		        $index_id = trim($_GET["id"]);
				$new_itsys_id = trim($_GET["new_itsys_id"]);
			    $new_desc = trim($_GET["new_desc"]);
			    if($index_id && $new_itsys_id){
			      $result = $conn->exec("UPDATE itsys_ip SET itsys_ip.itsys_id = '".$new_itsys_id."', itsys_ip.desc = '".$new_desc."' WHERE id = ".$index_id);
			      if($conn->changes())echo "<p>UPDATE SUCCESSFULLY</p>";
				  else echo "<p>FAILED</p>";
			    }
		        $result = $conn->query("SELECT itsys_ip.id AS itsys_ip_id, itsys_ip.desc AS itsys_ip_desc, itsys.id AS itsys_id, ip.name AS ip_name FROM itsys_ip, itsys, ip WHERE itsys_ip.itsys_id = itsys.id AND itsys_ip.ip_id = ip.id AND itsys_ip.id = ".$index_id);
			    $row = $result->fetchArray();
              ?>
			  <td><?php echo $row["itsys_ip_id"]; ?><input type = "hidden" name = "id" value = "<?php echo $row["itsys_ip_id"]; ?>" /></td>
			  <td><?php echo $row["ip_name"]; ?></td>
			  <td>
			    <select class = "white" name = "new_itsys_id">
				  <?php
	                $result_itsys_id = $conn->query("SELECT itsys.id, itsys.name FROM itsys ORDER BY id");
		            while($row_itsys_id = $result_itsys_id->fetchArray()){
				      if($row["itsys_id"] == $row_itsys_id["id"])echo "<option class = 'white' selected = 'selected' value = '".$row_itsys_id["id"]."'>".$row_itsys_id["name"]."</option>";
					  else echo "<option class = 'white' value = '".$row_itsys_id["id"]."'>".$row_itsys_id["name"]."</option>";
					}
	              ?>
				</select>
		      </td>
			  <td><input type = "text" class = "white" name = "new_desc" value = "<?php echo $row["itsys_ip_desc"]; ?>" /></td>
			  <td><a href = "<?php echo $_SERVER["SCRIPT_NAME"]."?id=".$row["itsys_ip_id"]; ?>">CANCEL</a><span class = "darkgolden"> OR </span><a id = "edit_submit" href = "#">SUBMIT</a></td>
			</tr>
		  </table>
		</form>
      </div>
	  <hr />
	</div>
    <div id = "footer">
	  <p>@2016 中国电信股份有限公司上海企业信息化运营中心<br>
	  基础设施室网络和安全组</p>
    </div>
  </div>
</body>
</html>