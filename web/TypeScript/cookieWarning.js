/**
 * Created by yorrickschwappacher on 19.10.16.
 */
// Asign current date to variable //
var currentDate = new Date();
// Create some DOM elements
var newCookiesWarningDiv = document.createElement("div");
// Retrieving cookie's information
function checkCookie(cookieName) {
    "use strict";
    var cookieValue, cookieStartsAt, cookieEndsAt;
    // Get all coookies in one string
    cookieValue = document.cookie;
    // Check if cookie's name is within that string
    cookieStartsAt = cookieValue.indexOf(" " + cookieName + "=");
    if (cookieStartsAt === -1) {
        cookieStartsAt = cookieValue.indexOf(cookieName + "=");
    }
    if (cookieStartsAt === -1) {
        cookieValue = null;
    }
    else {
        cookieStartsAt = cookieValue.indexOf("=", cookieStartsAt) + 1;
        cookieEndsAt = cookieValue.indexOf(";", cookieStartsAt);
        if (cookieEndsAt === -1) {
            cookieEndsAt = cookieValue.length;
        }
        // Get and return cookie's value
        cookieValue = encodeURI(cookieValue.substring(cookieStartsAt, cookieEndsAt));
        return cookieValue;
    }
}
// Cookie setup function
function setCookie(cookieName, cookieValue, cookiePath, cookieExpires) {
    "use strict";
    // Convert characters that are not text or numbers into hexadecimal equivalent of their value in the Latin-1 character set
    cookieValue = encodeURI(cookieValue);
    // If cookie's expire date is not set
    if (cookieExpires === "") {
        // Default expire date is set to 6 after the current date
        currentDate.setMonth(currentDate.getMonth() + 6);
        // Convert a date to a string, according to universal time (same as GMT)
        cookieExpires = currentDate.toUTCString();
    }
    // If cookie's path value has been passed
    if (cookiePath !== "") {
        cookiePath = ";path = " + cookiePath;
    }
    // Add cookie to visitors computer
    document.cookie = cookieName + "=" + cookieValue + ";expires = " + cookieExpires + cookiePath;
    // Call function to get cookie's information
    checkCookie(cookieName);
}
// Check if cookies are allowed by browser //
function checkCookiesEnabled() {
    "use strict";
    // Try to set temporary cookie
    setCookie("TestCookieExist", "Exist", "", "");
    // If temporary cookie has been set, delete it and return true
    if (checkCookie("TestCookieExist") === "Exist") {
        setCookie("TestCookieExist", "Exist", "", "1 Jan 2000 00:00:00");
        return true;
    }
    if (checkCookie("TestCookieExist") !== "Exist") {
        return false;
    }
}
// Add HTML form to the website
function acceptCookies() {
    "use strict";
    document.getElementById("cookiesWarning").appendChild(newCookiesWarningDiv).setAttribute("id", "cookiesWarningActive");
    document.getElementById("cookiesWarningActive").innerHTML = "<strong id='text'>Auch Mathematiker brauchen Kekse. Durch die Nutzung stimmst du zu, dass wir deine benutzen dürfen.</strong><span id='readMoreURL'></span><br/><strong><a id='cookiesAgreement' onclick='getAgreementValue()'>Hier, nehmt meine Kekse!</a> </strong>";
    // Change the URL of "Read more..." here
    document.getElementById("readMoreURL").innerHTML = "<a href='https://www.google.com/policies/technologies/cookies/' title='So verwendet Google Cookies' target='_blank' rel='nofollow'>Zeig mir mehr dazu!</a>";
}
function acceptCookiesTickBoxWarning() {
    "use strict";
    setCookie("TestCookie", "Yes", "", "1 Jan 2000 00:00:00");
    document.getElementById("cookiesWarning").appendChild(newCookiesWarningDiv).setAttribute("id", "cookiesWarningActive");
    document.getElementById("cookiesWarningActive").innerHTML = "<strong id='text'>Auch Mathematiker brauchen Kekse. Durch die Nutzung stimmst du zu, dass wir deine benutzen dürfen.</strong><span id='readMoreURL'></span><form name='cookieAgreement'><p id='warning'><small>Bitte aktivere die Checkbox!</small></p><input type='checkbox' name='agreed' value='Agreed' class='checkbox'><span class='acceptance'>Hier, nehmt meine Kekse!</span><input type='submit' value='Continue' onclick='getAgreementValue()' class='button'></form>";
    // Change the URL of "Read more..." here
    document.getElementById("readMoreURL").innerHTML = "<a href='https://www.google.com/policies/technologies/cookies/' title='So verwendet Google Cookies' target='_blank' rel='nofollow'>Zeig mir mehr dazu!</a>";
}
// Check if cookie has been set before //
function checkCookieExist() {
    "use strict";
    // Call function to check if cookies are enabled in browser
    if (checkCookiesEnabled()) {
        // If cookies enabled, check if our cookie has been set before and if yes, leave HTML block empty
        if (checkCookie("TestCookie") === "Yes") {
            document.getElementById("cookiesWarning").innerHTML = "";
        }
        else {
            acceptCookies();
        }
    }
    else {
        // Display warning if cookies are disabled on browser
        document.getElementById("cookiesWarning").appendChild(newCookiesWarningDiv).setAttribute("id", "cookiesWarningActive");
        document.getElementById("cookiesWarningActive").innerHTML = "<span id='cookiesDisabled'><strong>Cookies sind nicht aktiviert. Bitte aktiviere Cookies, damit wir dir das bestmögliche Erlebnis liefern können.</strong><br /> Dein Browser akzeptiert derzeit keine Cookies.</span>";
    }
}
// Get agreement results
function getAgreementValue() {
    "use strict";
    document.getElementById("cookiesWarning").innerHTML = "";
    setCookie("TestCookie", "Yes", "", "");
    // If agreement box has been checked, set permanent cookie on visitors computer
    /*if (document.cookieAgreement.agreed.checked) {
        // Hide agreement form
        document.getElementById("cookiesWarning").innerHTML = "";
        setCookie("TestCookie", "Yes", "", "");
    } else {*/
    // If agreement box hasn't been checked, delete cookie (if exist) and add extra warning to HTML form
    //acceptCookiesTickBoxWarning();
    //}
}
//# sourceMappingURL=cookieWarning.js.map