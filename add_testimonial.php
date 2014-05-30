<?

include("useractions.php");

sendTestimonialNotice($_POST["username"], $_POST["emailadd"],$_POST["post_code"], $_POST["country"], $_POST["date"], $_POST["testimonial"] );

//header("location:testimonial_received.php");
exit;
?>