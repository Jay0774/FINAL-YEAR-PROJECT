<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else {
  if(isset($_POST['update']))
  {
  $complaintnumber=$_GET['cid'];
  $status=$_POST['status'];
  $remark=$_POST['remark'];
  $query=mysqli_query($bd, "insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
  $sql=mysqli_query($bd, "update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");
  echo "<script>alert('Complaint details updated successfully');</script>";
  $s = mysqli_query($bd, "select userEmail from `users` WHERE id = (SELECT userId from `tblcomplaints` where complaintNumber = '$complaintnumber')");
  $r=mysqli_fetch_array($s);
  $to = $r['userEmail'];
  $subject = "Status Updated on Complaint Number $complaintnumber";
  $message = "<p> The status of the complaint number <b>$complaintnumber</b>, has been updated to <b>
  $status</b>, with remarks <b>$remark</b>.
  You can check more by logging into your account.
  </p>";
  $headers = "From: Final Year Project \r\n";
  $headers .= "Content-type: text/html\r\n";
  if(mail($to, $subject, $message, $headers)) {
  echo "<script>alert('Updation Details mailed to user.'); window.close();
    </script>";
  } else {
   echo "<script>alert('E-mail Sending Failed')</script>";
  }
  }

?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE">
<html>
<head>
<style>
input[type=text], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=text], textarea {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #black;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<title>Update Complaint</title>

</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updatecomplaint" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr height="50">
      <td><b>Complaint Number</b></td>
      <td><?php echo htmlentities($_GET['cid']); ?></td>
    </tr>
    <tr height="50">
      <td><b>Status</b></td>
      <td><select name="status" required="required">
      <option value="">Select Status</option>
      <option value="in process">In Process</option>
    <option value="closed">Closed</option>
        
      </select></td>
    </tr>


      <tr height="50">
      <td><b>Remark</b></td>
      <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
    </tr>
    


        <tr height="50">
      <td>&nbsp;</td>
      <td><input type="submit" name="update" value="Submit"></td>
    </tr>



       <tr><td colspan="2">&nbsp;</td></tr>
    
    <tr>
  <td></td>
      <td >   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="f2()" style="cursor: pointer;"  /></td>
    </tr>
   

 
</table>
 </form>

</div>

</body>
</html>

     <?php } ?>