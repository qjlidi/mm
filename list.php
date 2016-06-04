<?php
$conn = mysql_connect("localhost", root, 123654789);
if (! $conn) {
    die("数据库连接失败" . mysql_errno());
}

// 2.设置数据库编码
mysql_query("set names utf-8", $conn); // or die(mysql_errno());
                                       
// 3.选择数据库
mysql_select_db("mm"); //or die(mysql_errno());
echo "<h1>用户列表</h1>";
echo "<table border: 1px solid blue; position:absolute;top:5px;>";
echo "<tr><th>id</th><th>name</th><th>email</th><th>class</th><th>salar</th><th>删除</th><th>修改</th></tr>";

// 把显示列表封装成一个listm函数
function listm($page, $pageSize)
{
    global $conn;
    $rown = $page * $pageSize;
    $sql = "select * from emp limit $rown,$pageSize";
    $res = mysql_query($sql, $conn);
    
    while ($row = mysql_fetch_assoc($res)) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<th>" . $data . "</th> ";
        }
        echo "<th><a href='#'>删除</a></th>";
        echo "<th><a href='#'>修改</a></th>";
        echo "</tr>";
       
    }
}
// 默认显示第一页，每页4条


//查询总条数
$sql2 = "select count(id) from emp";
$res = mysql_query($sql2, $conn);

$rowCount=0;
$row = mysql_fetch_assoc($res);
$rowCount=$row[0];
foreach ($row as $data){
   $rowCount= $data;
}
$pagenow=1;
$pagesize=3;
if(!$_GET["page"]){
    $pagenow=1;
    listm(0, 4);
}
else {$pagenow=$_GET["page"]; 
listm($pagenow , 4);
}
$pageCount=ceil($rowCount/$pagesize);
echo "第";
for($i=1;$i<$pageCount-1;$i++){
    echo "<a href='list.php?page=".$i."'>  ".$i."</a>"; }
echo "页";
mysql_close($conn);

?>