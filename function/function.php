<?php
function de_quy_cate_select_box($arr_obj_cats,$id_parent,$space)
{
  foreach ($arr_obj_cats as $value) {
    if ($value->parent==$id_parent && $value->status==1) {
      echo '<option value = "'.$value->id_dm.'">';
      echo $space.'&nbsp'.$value->ten_danhmuc;
      echo '</option>';
      de_quy_cate_select_box($arr_obj_cats,$value->id_dm,$space.'--');
    }
  }
}
function cart_items(){
	$carts = isset($_SESSION['shopping']) ? $_SESSION['shopping'] : [];

	return $carts;
}


function totalQtt(){
	$t = 0;
	$carts = cart_items(); 
	foreach ($carts as $key => $item) {
		$t += $item['quantity'];
	}


	return $t;
}


function totalPrice(){
	$t = 0;
	$carts = cart_items();
	foreach ($carts as $key => $item) {
		$t += $item['quantity']*$item['price'];
	}


	return $t;
}
function wish_list(){
	$wish = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];

	return $wish;
}
function send_mail($mail_nhan,$body){

	require 'config/mailler/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->CharSet = 'UTF-8';
                                    // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'haifakerx@gmail.com';                 // SMTP username
	$mail->Password = 'hai0984946080';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to 465

	$mail->From = 'haifakerx@gmail.com';
	$mail->FromName = 'Dat hang ok';
	$mail->addAddress('c1807hbkap@gmail.com', 'Đỗ Trọng Hải');     // Add a recipient
	$mail->addAddress($mail_nhan);               // Name is optional
	// $mail->addReplyTo('info@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Thông báo đặt hàng ok';
	$mail->Body    = $body;
	// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	   return false;
	} else {
	    return true;
	}

}

?>
