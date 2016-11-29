<?php
// error_reporting(0);
//连接数据库
header('content-type:text/html;charset=utf-8');
try{

  $sdn = "mysql:host=localhost;dbname=phone_query";
  $username = 'root';
  $pwd = '';
  $pdo = new PDO($sdn,$username,$pwd);
  $pdo->query('set names utf8');

//获取页面信息
  $keyword = $_POST['keyword'];
  $num = substr($keyword,0,7);
  $sql = "SELECT num,quhao,city,type FROM shouji WHERE num = {$num}";
  // $stmt = $pdo->prepare($sql); //prepare($sql)准备SQL语句
  // $res = $stmt->execute();	//execute()执行预处理

  $res = $pdo->query($sql);
  // var_dump($res);
  if($res && $res->rowCount()) {
  	foreach($res as $row) {
  	  // print_r($row);
  	  $istrue = 1;
  	}
  }else {
  	$msg = "请输入正确的手机号码！";
  	$istrue = 0;
  }

}catch(PDOExcepion $e) { //捕获异常
  echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>手机归属地查询</title>
	<link rel="stylesheet" type="text/css" href="css/phone_query.css">
</head>
<body>
	<div class="main">
            <div class="top">
                <div class="tit">
                    手机归属地查询
                </div>
            </div>
            <div class="content">
                <div class="search">
                    <form action="" method="post">
                        <div class="sear"><input type="text" class="search_text" name="keyword" value placeholder="请输入手机号码" /></div>
                        <div class="bun"><input type="submit" class="bun_sub" name="sub" value="查询" />
                        <input type="reset" class="bun_res" name="reset" value="重置" /></div>
                    </form>    
                </div>
                <div class="result">
                	<?php
                		if($istrue == 1) {
                	?>
               		<p>您查询的手机号码为：<?php echo $keyword ?></p>
               		<p>所属的城市为：<?php echo $row['city'] ?></p>
               		<p>城市的区号为：<?php echo $row['quhao'] ?></p>
               		<p>卡的类型为：<?php echo $row['type'] ?></p>
               		<?php
               			}else {
               				echo "<p>$msg</p>";
               			}
               		?>
                </div>
            </div>
        </div>
    
</body>
</html>