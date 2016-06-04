<?php
$eid = $epass = $error = "";
if (! $_POST["id"]) {
    $eid = "id is empty ";
}
if (! $_POST["pass"]) {
    $epass = "password is empty ";
}
    // 不到数据库验证
    // if($_POST["id"]==88&&$_POST["password"]=="666"){
    // $id=$_POST["id"];
    // $password=$_POST["password"];
    // if($id=="88"&&$password="666")
    // header("Location:main.php");//跳转到main.php
    // exit();
    // }
    // else $error="<font color='red'>error</font>";
    
/*
 * 使用mysql扩展库连接
 */
  
$id=$_POST["id"];
$password=$_POST["password"];
    // 1.得到链接
$conn = mysql_connect("localhost", root, 123654789);
if (!$conn) {
    die("数据库连接失败" . mysql_errno());
}

// 2.设置数据库编码
mysql_query("set names utf-8", $conn); //or die(mysql_errno());

//3.选择数据库
mysql_select_db("mm") or die(mysql_errno());
//4.发送sql语句验证
$sql="select password,name from admin where id=$id";
$res=mysql_query($sql,$conn);
if($row=mysql_fetch_assoc($res))
{
    
    if($row["password"]==md5($password)){
        $name=$row["name"];
        header("Location:main.php?name=$name ");//跳转到main.php
        exit();
    }
}
//header("Location:main.php");
 $error="error";


?>


<html>
<body>
	<p>login</p>
	<form action="index.php" method="post">
		id:<input type="text" name="id"><?php echo $eid?></br> password:<input
			type="password" name="password"><?php echo $epass?></br> rember me：<input
			type="checkbox" name="cookies" value=""></br> <input type="submit"
			value="submit"></br>
<?php echo $error?>


</form>

</body>
</html>
