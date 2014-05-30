fixMozillaZIndex=true; //Fixes Z-Index problem with Mozilla browsers but causes odd scrolling problem, toggle to see if it helps
_menuCloseDelay=500;
_menuOpenDelay=150;
_subOffsetTop=0;
_subOffsetLeft=1;


with(menuStyle=new mm_style()){
align="center";
bordercolor="#FFFFFF";
borderstyle="solid";
borderwidth=0;
fontfamily="Verdana, Tahoma, Arial";
fontsize="11";
fontweight="bold";
fontstyle="normal";
itemheight=28;
menuheight=28;
/*headerbgcolor="#ffffff";
headercolor="#000000";
offbgcolor="#FFFFFF";
offcolor="#636464";
onbgcolor="#d9dda9";
oncolor="#c1002b";*/
/*outfilter="randomdissolve(duration=0.0)";*/
/*overfilter="Fade(duration=0.0);Alpha(opacity=100)";*/
padding=0;
}

with(submenuStyle=new mm_style()){
align="left";
bordercolor="#7f7f7f";
borderstyle="solid";
borderwidth=2;
fontfamily="Verdana, Tahoma, Arial";
fontsize="10";
fontweight="bold";
fontstyle="normal";
itemheight=31;
menuheight=31;
headerbgcolor="#FFFFFF";
headercolor="#000000";
offbgcolor="#1b1b1b";
offcolor="#e0e0e0";
onbgcolor="#1b1b1b";
oncolor="#7ae90a";
/*outfilter="randomdissolve(duration=0.0)";*/
/*overfilter="Fade(duration=0.0);Alpha(opacity=100)";*/
padding=7;
pagebgcolor="#7ae90a";
pagecolor="#1b1b1b";
separatorcolor="#7f7f7f";
separatorsize=2;
}

with(milonic=new menuname("Top Menu")){
alwaysvisible=1;
orientation="horizontal";
style=menuStyle;
itemheight="28";
aI("image=images/nav/n_home_o.gif;overimage=images/nav/n_home_x.gif;imageposition=top;status=Back To Home Page;url=index.php;");
aI("image=images/nav/n_about_us_o.gif;overimage=images/nav/n_about_us_x.gif;imageposition=top;status=About Us;url=content.php?page=2;");
aI("showmenu=refugechambers;image=images/nav/n_refuge_o.gif;overimage=images/nav/n_refuge_x.gif;imageposition=top;status=Refuge Chambers;url=content.php?page=3;");
aI("showmenu=otherproducts&services;image=images/nav/n_other_products_o.gif;overimage=images/nav/n_other_products_x.gif;imageposition=top;status=Other Products;url=content.php?page=4;");
aI("showmenu=newproducts;image=images/nav/n_new_products_o.gif;overimage=images/nav/n_new_products_x.gif;imageposition=top;status=New Products;url=content.php?page=5;");
aI("image=images/nav/n_testimonials_o.gif;overimage=images/nav/n_testimonials_x.gif;imageposition=top;status=Testimonials;url=content.php?page=6;");
aI("image=images/nav/n_news_o.gif;overimage=images/nav/n_news_x.gif;imageposition=top;status=News;url=content.php?page=7;");
aI("image=images/nav/n_contact_us_o.gif;overimage=images/nav/n_contact_us_x.gif;imageposition=top;status=Contact Us;url=content.php?page=8;");

