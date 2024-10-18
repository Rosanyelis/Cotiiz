/**
    Item Name: Engine - WebSite.
    Author: Desarrollos QV
    Version: 1.0
    Copyright 2022-2023
	Author URI: https://desarrollos-qv.com/
**/ 

(function($) {
    "use strict";

    /*--------------------- PopNewsLetter ---------------------- */
    
    $(document).ready(function() {

        
        /*----------------------------- Chk PopNewsLetter Cookie --------------------*/
        var privacyCookies = ecAccessCookie("privacyCookies");
        if (!privacyCookies || privacyCookies == "false")
        {
            $("#ec-modal-close").click(() => {
                ecCreateCookie('privacyCookies',true,1);
            });
        }
    });

})(jQuery);




