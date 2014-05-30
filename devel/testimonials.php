<?

session_start();

if(!isset($_COOKIE["currency"])){

	header("location:products_home.php?error=nocurrency&returnurl=".$PHP_SELF);

	exit;

}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>identi Kid - Testimonials</title>
<script Language="JavaScript" src="/ezytrack.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="keywords" content="Label,labels,labelling,personalised,labels,name,identikid,identi,kid,sticker,stickers,vinyl,iron,iron-on,tag,shoes,pencil,pack,fabric,bag,child,kidcards,kid,cards,clothing,lost,property,school">
<meta name="description" content="Personalised name labels that really work.  Includes microwave dishwasher safe vinyl stickers, iron-on clothing labels, shoe labels, pencil labels and lots more.  Design your own labels online, with your choice of fun fonts and pictures.  All products are high quality, attractive and easy to use.">
<script language="javascript" src="javascript.js"></script>
<script language="JavaScript" type="text/JavaScript">

<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function submitForm(){

	var emailVal=document.forms[0].emailadd.value;

	if(document.forms[0].username.value==""){

		alert('Please enter your name');

	}else if(document.forms[0].testimonial.value == ""){

		alert('Please enter your testimonial');

	}else if(emailVal == ""){

		alert('Please enter your email address');

	}else if(emailVal.indexOf('@')==-1 || emailVal.indexOf('@')==emailVal.length-1 || emailVal.indexOf('.')==-1 || emailVal.indexOf('.')==emailVal.length-1){

		alert('Please enter a valid email address');

	}else{

		document.forms[0].submit();

	}

}

//-->

</script>
<link href="css/identikid.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="d4d0c8" background="images/bg_pattern.gif" onLoad="MM_preloadImages('images/button_back_mo.gif','images/button_send_mo.gif')">
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="740" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="181" valign="top" background="images/bg_left_column.gif"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_top_products.gif" alt="Identi Kid" width="181" height="62" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_middle_products.gif" alt="Identi Kid" width="181" height="90" border="0"></a></td>
              </tr>
              <tr> 
                <td><a href="http://www.identikid.com.au"><img src="images/logo_bottom_products.gif" alt="Identi Kid" width="181" height="43" border="0"></a></td>
              </tr>
            </table></td>
          <td width="418" valign="top" bgcolor="#6FFF6F"> <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="#6FFF6F">
              <tr valign="top"> 
                <td width="60" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="60" height="10"></td>
                <td width="304" bgcolor="5d7eb9"><img src="images/heading_labels_for_littlies.gif" alt="name labels for school,kindy and life" width="304" height="62"></td>
                <td width="54" background="images/bg_blue_heading.gif"><img src="images/spacer_trans.gif" width="54" height="10"></td>
              </tr>
              <tr valign="top"> 
                <td colspan="3"><table width="418" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="6FFF6F"><div align="right"><img src="images/heading_testimonials.gif" alt="View Order" width="167" height="45"></div></td>
                      <td bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="50" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td colspan="2" bgcolor="6FFF6F"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr valign="top" bgcolor="#66FF66"> 
                <td colspan="3" bgcolor="#6FFF6F"> <table width="418" border="0" cellpadding="0" cellspacing="0" bgcolor="FFFFFF">
                    <tr> 
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                      <td width="393" valign="top" bgcolor="#FFFFFF"> <table width="393" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="97%">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td width="3%"><img src="images/spacer_trans.gif" width="20" height="10"></td>
                                  <td width="97%" class="headings"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                                      <tr> 
                                        <td width="86%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr> 
                                              <td><form name="form1" method="post" action="add_testimonial.php">
                                                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                                                    <tr> 
                                                      <td>Have you tried our products? 
                                                        Why not let us know what 
                                                        you think of them?</td>
                                                    </tr>
                                                    <tr> 
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr> 
                                                      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="maintext">
                                                          <tr> 
                                                            <td width="50%"><strong>Name</strong></td>
                                                            <td colspan="2"><strong>Email</strong></td>
                                                          </tr>
                                                          <tr> 
                                                            <td><input name="username" type="text" class="ordertext" size="28"></td>
                                                            <td colspan="2"><input name="emailadd" type="text" class="ordertext" size="30"></td>
                                                          </tr>
                                                          <tr> 
                                                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                                          </tr>
                                                          <tr> 
                                                            <td><strong>Testimonial</strong></td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                          <tr> 
                                                            <td colspan="3"><textarea name="testimonial" cols="41" rows="5"></textarea></td>
                                                          </tr>
                                                          <tr> 
                                                            <td colspan="3"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                                                          </tr>
                                                          <tr> 
                                                            <td><a href="javascript: submitForm();" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/button_send_mo.gif',1)"><img src="images/button_send.gif" alt="Send" name="Image20" width="86" height="22" border="0"></a></td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table>
                                                </form></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                      <tr> 
                                        <td><p><br>
                                            <strong>TESTIMONIALS</strong> <br>
                                            <br>
                                            Love the website! Very clear and simple 
                                            to use and move around! <br>
                                            Thanks<br>
                                            <strong>Simon</strong></p>
                                          <p>I can't believe how quickly I received 
                                            my order! I placed my order on the 
                                            Saturday and received it five days 
                                            later on Thursday. I've never received 
                                            a purchase over the net this fast! 
                                            And I have to say what a brilliant 
                                            web site you have. So precise but 
                                            most of all, so easy to use. The labels 
                                            have come in very handy and I will 
                                            most definitely order from you again. 
                                            Thank you!<br>
                                            <b>Christine </b><br>
                                          </p>
                                          <p>I found that your web site was the 
                                            best that I have come across. I not 
                                            only ordered some labels for my kids 
                                            but for myself aswell! Congrats on 
                                            a fab business!<br>
                                            <b>Lee </b><br>
                                          </p>
                                          <p>Just had to email you to say how 
                                            impressed I am with your product. 
                                            I have recently purchased labels from 
                                            another company over the net and waited 
                                            3 months for my labels to arrive! 
                                            Decided to try you guys and found 
                                            a great user friendly web site, ordering 
                                            and payment system. Plus my order 
                                            arrived in 10 days. Very impressed! 
                                            As my oldest of 3 children is turning 
                                            4, I hope to enjoy your products for 
                                            many years to come.<br>
                                            <strong>Vanessa</strong></p>
                                          <p>This is a good,clear, and well organised 
                                            website and the labels are fantastic!!!!! 
                                            <strong><br>
                                            Helen </strong> </p>
                                          <p>Fantastic products! The only ones 
                                            that Ive tried that survive endless 
                                            washing both in the machine and the 
                                            sink! The shoe labels are great - 
                                            they havent moved at all! Can honestly 
                                            say that every label is still in place! 
                                            My 2 1/2 yr old daughter loves finding 
                                            her 'fairy' on all her things, which 
                                            means everything finds its way home. 
                                            Thanks for such a great and durable 
                                            product! <br>
                                            <strong>Letitia </strong></p>
                                          <p> I have used identiKid lables since 
                                            my first child was born 5 years ago. 
                                            I still have some of his baby things 
                                            with the lables on them that have 
                                            not peeled or cracked and are still 
                                            being used by my daughter. These are 
                                            fun affordable and most importantly, 
                                            durable and long lasting lables. I 
                                            also love how easy it is to order.<br>
                                            Thank you!<br>
                                            <strong>Julie</strong> </p>
                                          <p>Thank you so much for the absolutely 
                                            fantastic vinyl labels we ordered 
                                            from identiKid - they look great on 
                                            our daughter's things. We can stick 
                                            them on everthing!!! Thank you again 
                                            for an amazing product, we will be 
                                            ordering many more in the future and 
                                            telling all our friends about your 
                                            superb service &amp; product range.<br>
                                            <strong>Nicky &amp; Hunter English.</strong></p>
                                          <p>I thank you for making sure we - 
                                            the customers are satisfied - the 
                                            sign of a truly professional business. 
                                            If I was handing out customer service 
                                            awards I would be sending you one!<br>
                                            <strong>Karen</strong></p>
                                          <p>I ordered and received my starter 
                                            kit a while ago but have only just 
                                            realised how fantastic it is since 
                                            my son started school. Everyone comments 
                                            on his dinosaur bag tag and he loves 
                                            the fact that he can recognise his 
                                            things all by himself. Beautiful, 
                                            bright and hard wearing and don't 
                                            cost the earth. What a wonderful Aussie 
                                            product. Will be back for more when 
                                            my daughter starts school!!!<br>
                                            <strong>Tanya</strong></p>
                                          <p>I recieved the 'Starter Pack' in 
                                            the mail the other day. Firstly, it 
                                            arrived earlier than expected, which 
                                            was great. Secondly &amp; more importantly, 
                                            it was fantastic. My son loves the 
                                            bag tags. Thanks again for your help 
                                            &amp; paitence when I was ordering 
                                            &amp; once again 'Thanks' for the 
                                            great product. I think I'm more excited 
                                            about my son Cameron starting kindy 
                                            now, than he is!<br>
                                            <strong>Donna</strong></p>
                                          <p>Thanks for the excellent service 
                                            and the wonderful products. My girls 
                                            love them. Now their cousins and friends 
                                            are so keen to get some for themselves 
                                            too!<br>
                                            <strong>Rebecca</strong></p>
                                          <p> Identi kid are fun &amp; convenient 
                                            for labelling the kids' school things. 
                                            I keep them in my pantry &amp; use 
                                            them a lot.<br>
                                            <strong>Colette</strong> </p>
                                          <p>I've placed my first order finally, 
                                            if I knew how esay your web site would 
                                            be, I would of done it months ago. 
                                            Congratulation on an excellent web 
                                            site.<br>
                                            <strong>Del</strong></p>
                                          <p>Your products are fantastic. I ordered 
                                            a starter's pack last year and it 
                                            was fabulous. I have re-ordered again 
                                            this year for a top-up supply as the 
                                            labels I used last year are still 
                                            going strong (in fact, they seem to 
                                            outlast the items they were placed 
                                            on!). When other parents comment on 
                                            the bright, beautifully designed labels 
                                            on my daughter's things, I tell them 
                                            where to get some from. I am really 
                                            impressed with your product, service 
                                            and fast delivery and will keep spreading 
                                            the news. Keep up the good work and 
                                            thanks for a terrific product.<br>
                                            <strong>Nathalie</strong></p>
                                          <p>We have just ordered again and your 
                                            website is brilliant! Our 2 girls 
                                            love your labels and can never decide 
                                            on which cute picture to use! Thanks 
                                            for having such a great product.<br>
                                            <strong>Zoe</strong> </p>
                                          <p>Congratulations on a fabulous product. 
                                            I found the online ordering system 
                                            a breeze and the labels have graced 
                                            everything from drink bottles to gumboots 
                                            to my son's wheelbarrow!<br>
                                            A marvellous service, keep up the 
                                            good work.<br>
                                            <strong>Marianne </strong></p>
                                          <p>Just wanted to let you know that 
                                            I received my pack today in the mail. 
                                            <br>
                                            Thank you very much, I'm most impressed! 
                                            I know that after browsing through 
                                            Sydney's child and looking at all 
                                            the different label providers that 
                                            I chose the right one. My kids just 
                                            love the bag tags!<br>
                                            Your website is great, and I liked 
                                            the fact I could pay by DD. Thanks 
                                            again<br>
                                            <strong>Marina</strong> </p>
                                          <p>thankyou so much for the promptness 
                                            of my delivieries, and the quality 
                                            and presentation of the labels. They 
                                            are fantastic, and we are using them 
                                            already on our beach toys and drink 
                                            bottles. The kids love them!<br>
                                            <strong>Tracey </strong></p>
                                          <p> I have ordered a couple of times 
                                            from you website. I found it easy 
                                            to do and I was not disappointed at 
                                            all when the product arrived. Brilliant 
                                            idea and makes my life a lot easier 
                                            naming my daughters things for childcare!<br>
                                            <strong>Olivia</strong></p>
                                          <p>Just wanted to say excellent web 
                                            site. Haven't ordered anything yet, 
                                            just starting my research on products, 
                                            prices etc but your web site has to 
                                            be one of the cleanest and easiest 
                                            ones to use I have come across.<br>
                                            <strong>Lisa </strong></p>
                                          <p>I just placed my first order. The 
                                            web site was easy to find your way 
                                            around and the ordering system was 
                                            the easiest I've ever used. Well done 
                                            on a great site!<br>
                                            <strong>Emma Davis<br>
                                            Busy Mother of 3 daughters (7yrs, 
                                          5yrs, 2.5yrs)</strong></p>
                                          <p>&nbsp;</p>
                                          <p>Just wanted to let you   know that I ordered a starter pack about 3 years ago and they are still going   strong. My lunch boxes and drink bottles died well before the labels ever will!   Congratulations on a fantastic product. I will definitely be back when I am   ready for my son&rsquo;s labels. And your website is amazing &ndash; so easy to use,   professional and colourful and fun &ndash; my daughter had great fun choosing a   different icon this time (about three times!!).<br>
                                            <b>Brett</b><br>
                                          </p></td>
                                      </tr>
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td>&nbsp;</td>
                                  <td class="headings">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                      <td width="10" rowspan="3" valign="top" bgcolor="#FFFFFF" class="smalltext"><img src="images/spacer_trans.gif" width="15" height="10"></td>
                    </tr>
                    <tr valign="top" bgcolor="#FFFFFF"> 
                      <td><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr valign="top"> 
                      <td bgcolor="#FFFFFF"><table width="198" border="0" align="right" cellpadding="0" cellspacing="0">
                          <tr> 
                            <td width="47%">&nbsp;</td>
                            <td width="5%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="10%">&nbsp;</td>
                            <td width="5%"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                            <td width="33%"><a href="javascript:history.go(-1)" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('back','','images/button_back_mo.gif',1)"><img src="images/button_back.gif" alt="Back" name="back" width="94" height="22" border="0"></a></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td colspan="3" valign="top"><img src="images/spacer_trans.gif" width="10" height="10"></td>
                    </tr>
                    <tr bgcolor="#6FFF6F"> 
                      <td colspan="3" valign="top"><br> </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
          <td valign="top" bgcolor="FF9900"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><img src="images/image_phone_heading.gif" alt="Ph: +61 2 6971 0969" width="141" height="62"></td>
              </tr>
              <tr> 
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td valign="top"> 
                        <?php include "navigation.php"; ?>
                      </td>
                    </tr>
                    <tr> 
                      <td> 
                        <?php include "orders.php" ?>
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" colspan="3" valign="top"> 
            <?php include "footer.php" ?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<script Language="JavaScript" src="http://www.ezytrack.com/returns.js?ezaccount=439"></script>
</body>
</html>
