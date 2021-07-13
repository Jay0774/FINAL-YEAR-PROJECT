<?php
    session_start();
    error_reporting(0);
    include("include/config.php");
    if(isset($_POST['submit'])) {
        $query = mysqli_query($bd, "select tblcomplaints.*,users.fullName as name,category.categoryName as catname from tblcomplaints join users on users.id=tblcomplaints.userId join category on category.id=tblcomplaints.category where tblcomplaints.complaintNumber='".$_POST['cid']."'");
        $ret=mysqli_query($bd, "select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='".$_POST['cid']."'");
        $row = mysqli_fetch_array($query);
        $cfile=$row['complaintFile'];
        $complaintNumber = $row["complaintNumber"];
        $name = $row["name"];
        $regDate = $row["regDate"];
        $college = $row["catname"];
        $dept = $row["subcategory"];
        $complaintType = $row["complaintType"];
        $state = $row["state"];
        $noc = $row["noc"];
        $complaintDetails = $row["complaintDetails"];
        $status;
        if($row['status']=="") { 
            $status = "Not Process Yet";
        } else {
            $status = $row['status'];
        }
        $file;
        if($cfile=="" || $cfile=="NULL"){
			$file = "";
		} else {
            $file = "../users/complaintdocs/";
            $file .= $cfile;
        }

        $to = $_POST["emailModal"];
        $from = "webmastercmsctae@gmail.com";
        $fromName = "Web Master CTAE CMS";
        $subject = "[CMS] ";
        $subject .= $noc;
        
        $headers = "From: $fromName \n";
        $headers .= "Reply-To: webmastercmsctae@gmail.com";

        $htmlContent = '<table rules="all" width="100%" style="border:1px solid #333" cellpadding="5px">
        <tr>
        <td><b>Complaint Number:</b></td><td>';
        $htmlContent .= $complaintNumber;
        $htmlContent .= '</td>
        <td>';
        $htmlContent .='<b>Complainant Name:</b></td>
        <td>';
        $htmlContent.= $name;
        $htmlContent .= '</td>
        <td><b>Reg Date:</b></td>
        <td>';
        $htmlContent .= $regDate;
        $htmlContent .= '</td>
        </tr>
        <tr>
        <td><b>College:</b></td>
        <td>';
        $htmlContent .= $college;
        $htmlContent .= '</td>
        <td><b>Category:</b></td>
        <td>';
        $htmlContent .= $dept;
        $htmlContent .= '</td>
        <td><b>Complaint Type:</b></td>
        <td>';
        $htmlContent .= $complaintType;
        $htmlContent .= '</td>
        </tr>
        <tr>
        <td><b>State of residence:</b></td>
        <td>';
        $htmlContent .= $state;
        $htmlContent .= '</td>
        <td ><b>Nature of Complaint:</b></td>
        <td colspan="3">';
        $htmlContent .= $noc;
        $htmlContent .= '</td>
        </tr>
        <tr>
        <td><b>Complaint Details:</b></td>
        <td colspan="5">';
        $htmlContent .= $complaintDetails;
        $htmlContent .= '</td>
        </tr>
        <tr>
        <td><b>Final Status</b></td>
	    <td colspan="5">';
        $htmlContent .= $status;
        $htmlContent .= '
        </td>								
		</tr>
        </table>
        ';
        
        // Boundary  
        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
         
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
         
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
         
        // Preparing attachment 
        if(!empty($file) > 0){ 
            if(is_file($file)){ 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($file,"rb"); 
                $data =  @fread($fp,filesize($file)); 
         
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
                "Content-Description: ".basename($file)."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $from; 
         
        if(mail($to, $subject, $message, $headers, $returnpath)) {
            echo "<script>
                  alert('Mail has been sent');
                  window.location = 'notprocess-complaint.php';
                  </script>";
        } else {
            echo "<script>
                  alert('E-mail Sending Failed')
                  window.location = 'not-process-complaint.php';
                  </script>";
        }
    }
?>