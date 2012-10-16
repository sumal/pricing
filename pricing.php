<?php
$future_price=0;
$form_error="";
if (isset($_POST['frm_submit_confirm']) == "submit"){
$current_price = mysql_real_escape_string($_POST['current_price']);
$days = mysql_real_escape_string($_POST['days']);
if(!$current_price||!$days){
$form_error ="Please Enter values";
}
$conn = mysql_connect( "localhost", "root", "" );
$db_selected=mysql_select_db( "test", $conn );    #selects a database
$q = " SELECT `rate` FROM interest WHERE `day`='$days'";//sql escape and query format
$res = mysql_query( $q, $conn);//or die(mysql_error());
$row = mysql_fetch_assoc($res);
$rate=$row['rate'];
//F = S * e ^ (r*t)
$exp_value=$rate*$days*0.00002739726;
$future_price=$current_price*exp($exp_value);
	//~ print_r($future_price);
	//~ exit;


}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<form id="form_1" name="form_1" method="post" action="pricing.php">
<table width="367" border="1" align="center" cellpadding="2" cellspacing="0">
<input type="hidden" value="submit" name="frm_submit_confirm">
<?php if($form_error!=""){?>
 <tr>
    <td colspan="2" align ="center"><span style="color:red"><?php echo $form_error?></span></td>
  </tr>
  <?php }?>
  <tr>
    <td colspan="2" align ="center">Future Price calculator</td>
  </tr>
  <tr>
    <td width="155" bgcolor="#999999">Enter Current Price</td>
    <td width="204" bgcolor="#999999">
      <input type="text" name="current_price" id="current_price" />
    </td>
  </tr>
  <tr>
    <td bgcolor="#999999">Select Number Of days</td>
    <td bgcolor="#999999">
      <select name="days" id="days" >
      <option value="">--Select--</option>
      <option value="1">1</option>
      <option value="30">30</option>
      <option value="60">60</option>
      <option value="90">90</option>
      <option value="210">210</option>
      </select>
    </td>
  </tr>
   <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#999999"><input type="submit" value="calculate"/></td>
  </tr>
  <tr>
    <td bgcolor="#999999">Future Price will be</td>
    <td bgcolor="#999999"><?php echo$future_price?></td>
  </tr>
</table>
</form>