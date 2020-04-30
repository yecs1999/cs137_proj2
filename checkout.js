var product;
var method;
var address;

const getProduct = ()=>
{
    let query = window.location.search.substring(1);
    let query_list = query.split("&");
    var dict = new Object();
    for (var i = 0; i < query_list.length; ++i)
    {
        let kv = query_list[i].split("=");
        dict[kv[0]] = decodeURIComponent(kv[1]);
    }
    return dict;
}

function productToString() {
    var str = product["make"] + " ";
    str += product["model"] + " ";
    str += product["trim"];
    return str;
}

function setupCheckout() {
    product = getProduct();
    document.getElementById("product").innerText = "Order for " + productToString();
}

function isDigit(event, fieldName) {
    var key = event.keyCode;

    if(key > 47 && key < 58) {
        return true;
    }
    //alert("Only digits are allowed in the " + fieldName + " field.");
    return false;
}

function eraseNonDigits(value) {
    var str = "";
    for(var i = 0; i < value.length; ++i) {
        if(value.charCodeAt(i) > 47 && value.charCodeAt(i) < 58) {
            str += value.charAt(i);
        }
    }
    return str;
}

function conformIntlCode(value) {
    document.getElementById("code").value = "+" + eraseNonDigits(value);
    conformPhoneNumber("");
}

function setCursorPosition(field, position) {
    if(field.setSelectionRange) {
        //field.focus();
        field.setSelectionRange(position, position);
    }
}

function conformPhoneNumber(value) {
    var num = eraseNonDigits(value);
    if(document.getElementById("code").value === "+1") {
        var str = "(   )   -    ";
        for(var i = 0; i < num.length; ++i) {
            str = str.replace(" ", num.charAt(i));
        }
        var phone = document.getElementById("phone");
        document.getElementById("phone").value = str;
        var cursor = 1 + num.length;
        if(cursor >= 5) cursor += 1;
        if(cursor >= 9) cursor += 1;
        setCursorPosition(document.getElementById("phone"), cursor);
    } else
        document.getElementById("phone").value = num;
}

function fillAddress() {
  address = new Array(5);
  address[0] = document.getElementById("country");
  address[1] = document.getElementById("address");
  address[2] = document.getElementById("city");
  address[3] = document.getElementById("state");
  address[4] = document.getElementById("zip");
}

function enableAddress() {
    method = document.getElementById("method").value;
    fillAddress();
    if(method === "pickup") {
        address.forEach(field => field.disabled = true);
    } else {
        address.forEach(field => field.disabled = false);
    }
}

function addressToString() {
    var str = address[1].value + ", ";
    str += address[2].value + ", ";
    str += address[3].value + " " + address[4].value;
    return str;
}

function fieldsEmpty(listOfFields, listOfFieldsNames){
    for (i = 0; i<listOfFields.length; ++i)
    {
        if(method === "pickup" && i === 5) i = 10;
        let clearedElement = listOfFields[i].trim();
        if(clearedElement === "")
        {
            alert("Your " + listOfFieldsNames[i] + " cannot be blank. Please enter a " + listOfFieldsNames[i] + ".");
            return true;
        }
    }
    return false;
}

function creditCheck(card,cvv){
    if(card.length <= 19 && cvv.length == 3){
        return true;
    }
    else{
        alert("Your Credit card info is invalid. Please check CVV or Card");
        return false;
    }
}

function emailCheck(email) {
    var emailRegExp = /^\w+[\w-\.]*\@\w+((-\w+)|\w*)\.[a-z]{2,3}$/
    if(emailRegExp.test(email)) {
        return true;
    }
    alert("Your E-mail is invalid. Please use a valid address.");
    return false;
}

function submitCheckout() {
    //product = document.getElementById("product").innerText;
    var checkoutForm = document.getElementById("checkoutForm");
    var firstname = checkoutForm.firstname.value;
    var lastname = checkoutForm.lastname.value;
    var code = checkoutForm.code.value;
    var phone = checkoutForm.phone.value;
    var email = checkoutForm.email.value;
    fillAddress();
    method = checkoutForm.method.value;
    var card = checkoutForm.card.value;
    var cvv = checkoutForm.cvv.value;

    let allFields = [firstname, lastname, code, phone, email, address[0].value, address[1].value, address[2].value, address[3].value, address[4].value, card, cvv];
    let allFieldsName = ["First Name", "Last Name", "International Code", "Phone Number", "Email-Address", "Country", "Street Address", "City", "State/Provence", "Postal Code", "Card Number", "CVV"];
    if (!fieldsEmpty(allFields,allFieldsName) && creditCheck(card,cvv) && emailCheck(email)){
        console.log("Hi, " + firstname + " " + lastname + "!");
        var composeEmail = "mailto:" + email
            + "?subject=Vending Cars Order Confirmation"
            + "&body=Hi, " + firstname + " " + lastname + "! Your order for " + productToString() + " has been placed ";
        if(method === "pickup") {
            composeEmail += "and will be ready for pickup. ";
        } else if(method === "standard") {
            composeEmail += "and will be delivered to " + addressToString() + " in 7 days. ";
        } else {
            composeEmail += "and will be delivered to " + addressToString() + " in 4 days. ";
        }
        composeEmail += "%0A%0AIf there is any delay, we will call your number at " + phone + ". "
            + "%0A%0AThank you for shopping from Vending Cars!%0A%0A";
        window.location.href = composeEmail;
    }
}
