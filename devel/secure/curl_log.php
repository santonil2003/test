* About to connect() to earth.australis.net.au port 443
*   Trying 203.23.176.115... * connected
* Connected to earth.australis.net.au (203.23.176.115) port 443
* successfully set certificate verify locations:
*   CAfile: /usr/share/curl/curl-ca-bundle.crt
  CApath: none
* SSL connection using DHE-RSA-AES256-SHA
* Server certificate:
* 	 subject: /C=AU/ST=NSW/L=North Ryde/O=Multibase WebAustralis Pty Ltd/CN=earth.australis.net.au
* 	 start date: 2007-12-31 01:34:25 GMT
* 	 expire date: 2009-01-17 05:34:09 GMT
* 	 common name: earth.australis.net.au (matched)
* 	 issuer: /C=ZA/O=Thawte Consulting (Pty) Ltd./CN=Thawte SGC CA
* SSL certificate verify ok.
> POST /epay/servlet/CardClearingServlet HTTP/1.1
Host: earth.australis.net.au
Pragma: no-cache
Accept: */*
Content-Length: 159
Content-Type: application/x-www-form-urlencoded

Cust_Card=1234123412341234&Cust_Card_MM=08&Cust_Card_YY=13&SC_Merch=identikid&SC_Order=70534&SC_Amount=2250&ACTION=S&W=true&DETAILS=CC Name: Mine&submit=SUBMIT< HTTP/1.1 200 OK
< Date: Mon, 25 Aug 2008 08:32:47 GMT
< Server: Apache-Coyote/1.1
< Content-Type: text/plain;charset=ISO-8859-1
< Transfer-Encoding: chunked
* Connection #0 to host earth.australis.net.au left intact
* Closing connection #0
