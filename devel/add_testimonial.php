<?

include("useractions.php");

sendTestimonialNotice($_POST["username"], $_POST["emailadd"], $_POST["testimonial"]);

header("location:testimonial_received.php");
exit;
?>