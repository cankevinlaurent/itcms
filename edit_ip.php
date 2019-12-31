<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>编辑 - IP地址</title>
  <meta name = "keywords" content = "ip address, edit" />
  <meta name = "description" content = "编辑IP地址" />
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
		    <tr><th>IP_ID</th><th>NAME</th><th>DESCRIPTION</th><th>ACTION</th></tr>
			<tr>
			  <?php
		        $index_id = trim($_GET["id"]);
			    $new_name = trim($_GET["new_name"]);
			    $new_desc = trim($_GET["new_desc"]);
			    if($index_id && $new_name){
			      $result = $conn->exec("UPDATE ip SET name = '".$new_name."', desc = '".$new_desc."' WHERE id = ".$index_id);
			      if($conn->changes())echo "<p>UPDATE SUCCESSFULLY</p>";
				  else echo "<p>FAILED</p>";
			    }
		        $result = $conn->query("SELECT * FROM ip WHERE id = ".$index_id);
			    $row = $result->fetchArray();
              ?>
			  <td><?php echo $row["id"]; ?><input type = "hidden" name = "id" value = "<?php echo $row["id"]; ?>" /></td>
			  <td><input type = "text" class = "white" name = "new_name" value = "<?php echo $row["name"]; ?>" /></td>
			  <td><input type = "text" class = "white" name = "new_desc" value = "<?php echo $row["desc"]; ?>" /></td>
			  <td><a href = "<?php echo $_SERVER["SCRIPT_NAME"]."?id=".$row["id"]; ?>">CANCEL</a><span class = "darkgolden"> OR </span><a id = "edit_submit" href = "#">SUBMIT</a></td>
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