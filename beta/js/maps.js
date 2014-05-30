//--------------------------------------------------------------------
// Google Maps Ajax Load (Only Loads when a map is found on the page) 
//--------------------------------------------------------------------

   var maps = '';
   var googleApiKey = '';
  
   function init(){
   
    googleApiKey = "ABQIAAAAsdBIeJOOOrxpYljOPtIK8BT3YGt0p1R5aOw1kdsNep2UiU_JwBRXLKZmKzOY6HOhQNGa4Yzy5BRnqA";
    maps = getElementsByName_iefix("div", "g_map_init");
    
    if(maps.length>0) {
      initLoader();  
    }

   }


   function loadMaps() {
    google.load("maps", "2", {"callback" : mapsLoaded});
   }
   
   function mapsLoaded() {
   
     window.onunload=GUnload;
   
     for (i=0;i<maps.length;i++){
       code=maps[i].id;
       eval(code+'();');  
     }
      
   }

   function initLoader() {
    var script = document.createElement("script");
    script.src = "http://www.google.com/jsapi?key="+googleApiKey+"&callback=loadMaps";
    script.type = "text/javascript";
    document.getElementsByTagName("head")[0].appendChild(script);
   }

   function getElementsByName_iefix(tag, name) {
       
    var elem = document.getElementsByTagName(tag);
          var arr = new Array();
           for(i = 0,iarr = 0; i < elem.length; i++) {
                att = elem[i].getAttribute("name");
                if(att == name) {
                     arr[iarr] = elem[i];
                     iarr++;
                }
           }
           return arr;
   } 