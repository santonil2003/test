with(milonic=new menuname("Top Menu")){
alwaysvisible=1;
orientation="horizontal";
style=menuStyle;
position="relative";
imageheight:44;
itemheight:44;
zindex=80;
aI("showmenu=home_menu;image=images/nav/n_home_o.gif;overimage=images/nav/n_home_x.gif;imageposition=top;status=Back To Home Page;url=index.php;");
aI("showmenu=products;image=images/nav/n_products_o.gif;overimage=images/nav/n_products_x.gif;imageposition=top;status=Products;url=products.php;");
aI("image=images/nav/n_feedback_o.gif;overimage=images/nav/n_feedback_x.gif;imageposition=top;status=Back To Home Page;url=feedback.php;");
aI("image=images/nav/n_my_order_o.gif;overimage=images/nav/n_my_order_x.gif;imageposition=top;status=Contact Us;url=my_order.php;");
aI("image=images/nav/n_agents_o.gif;overimage=images/nav/n_agents_x.gif;imageposition=top;status=Back To Home Page;url=agents.php;");
aI("image=images/nav/n_fundraisers_o.gif;overimage=images/nav/n_fundraisers_x.gif;imageposition=top;status=Contact Us;url=fundraisers.php;");
aI("image=images/nav/n_contact_us_o.gif;overimage=images/nav/n_contact_us_x.gif;imageposition=top;status=Contact Us;url=contact_us.php;");
}

with(milonic=new menuname("home_menu")){
style=menuSub;
aI("text=How to Order;url=how_to_order.php");
aI("text=Order Form;url=pdf/order_form.pdf;target=_blank");
aI("text=Fonts & Pics;url=fonts_and_pics.php");
aI("text=About Us;url=about_us.php");
aI("text=Send to a Friend;url=send_to_a_friend.php");
aI("text=Links;url=links.php");
aI("text=Competition;url=competition.php");
aI("text=Privacy Policy;url=privacy_policy.php");
aI("text=Sitemap;url=sitemap.php");
}

with(milonic=new menuname("products")){
style=menuSub;
aI("text=Labels;url=prod_labels.php");
aI("text=Clothing Labels;url=prod_clothing_labels.php");
aI("text=Thingamejigs;url=prod_thingamejigs.php");
aI("text=Packs;url=prod_packs.php");
aI("text=Tags;url=prod_tags.php");
aI("text=Medical Alert;url=prod_medical_alerts.php");
aI("text=Identibands;url=prod_identibands.php");
aI("text=Gift Ideas & Packaging;url=prod_gift_packaging.php");
aI("text=Gift Vouchers;url=prod_gift_vouchers.php");
}



drawMenus();




