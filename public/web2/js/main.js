 /**
    Item Name: Engine website
    Author: DesarrollosQV
    Version: 3.1
    Copyright 2022
	Author URI: https://desarrollos-qv.com/
**/

// Function To Create New Cookie 
function ecCreateCookie(cookieName,cookieValue,daysToExpire)
{
    var date = new Date();
    date.setTime(date.getTime()+(daysToExpire*24*60*60*1000));
    document.cookie = cookieName + "=" + cookieValue + "; expires=" + date.toGMTString();
}

// Function To Delete Existing Cookie
function ecDeleteCookie(cookieName,cookieValue)
{
    var date = new Date(0).toGMTString();
    document.cookie = cookieName + "=" + cookieValue + "; expires=" + date;
}

// Function To Access Existing Cookie
function ecAccessCookie(cookieName)
{
    var name = cookieName + "=";
    var allCookieArray = document.cookie.split(';');
    for(var i=0; i<allCookieArray.length; i++)
    {
        var temp = allCookieArray[i].trim();
        if (temp.indexOf(name)==0){
            return temp.substring(name.length,temp.length);
        }
    }

    return "";
}