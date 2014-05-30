<html>
<head>
  <title>GV Test</title>
  <script type="text/javascript">
    var pwin;

    function printImg() {
      pwin = window.open("http://www.identikid.com.au/temp/giftvoucher_print.php?cust=1","_blank");
      setTimeout("pwin.print()",5000);
    }
    
  </script>
</head>
<body>
  <input type="button" onclick="printImg()" value="PRINT">
</body>
</html>