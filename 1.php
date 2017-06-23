<?php 

echo<<<aa
<script type="text/javascript">
aa;
$x=555;
?>
alert(<?php echo $x;?>);
//ตรงนี้ก้ใส่ฟังก์ชั่นเข้าไป
<?php
echo '</script>';

?>