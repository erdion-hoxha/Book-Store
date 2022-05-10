var check = true;

function makeInvalid(element) {
  element.removeClass("is-valid");
  element.addClass("is-invalid");
  check = false;
}

function makeValid(element) {
  element.removeClass("is-invalid");
  element.addClass("is-valid");
}

function checkIfEmpty(element, errorSpan) {
  // debugger;
  var value = element.val().trim();
  if (value != "") {
    errorSpan.hide();
    return true;
  } else {
    makeInvalid(element);
    errorSpan.html("Fusha eshte bosh");
    errorSpan.show();
    return false;
  }
}

function checkString(element, errorSpan) {
  // debugger;
  var value = element.val().trim();
  if (checkIfEmpty(element, errorSpan)) {
    var Regex = new RegExp(/^[a-zA-Z]{3,20}$/);
    console.log(Regex.test(value));
    // console.log(Regex.test(element));
    if (Regex.test(value)) {
      errorSpan.hide();
      element.removeClass("is-invalid");
      element.addClass("is-valid");
      return true;
    } else {
      if (value.length < 3) {
        errorSpan.html("Emri juaj duhet te kete te pakten 3 karaktere");
        errorSpan.show();
        makeInvalid(element);
      } else if (value.length > 30) {
        errorSpan.html("Emri juaj duhet te kete te shumten 30 karaktere");
        errorSpan.show();
        makeInvalid(element);
      }
      // errorSpan.html("Pranohen vetem karatere");
      // errorSpan.show();
      // element.removeClass("is-valid");
      // element.addClass("is-invalid");
      return false;
    }
  } else
    return false;
}

function checkEmail(element, errorSpan) {
  // debugger;
  if (checkIfEmpty(element, errorSpan)) {
    var value = element.val().trim();
    var regex = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (!regex.test(value)) {
      errorSpan.html("Email nuk eshte i formatit te kerkuar");
      errorSpan.show();
      makeInvalid(element);
      return false;
    }
    errorSpan.hide();
    makeValid(element);
    return true;
  } else {
    return false;
  }
}

function checkStrength(password, errorSpan) {
  // debugger;
  if (checkIfEmpty(password, errorSpan)) {
    var strength = 0;
    var value = password.val().trim();
    if (value.length < 6) {
      errorSpan.html("Gjatesia eshte me e vogel se 6");
      errorSpan.show();
      makeInvalid(password);
      return false;
    }
    if (value.length > 7) strength += 1
    // If password contains both lower and uppercase characters, increase strength value.  
    if (value.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
    // If it has numbers and characters, increase strength value.  
    if (value.match(/([a-zA-Z])/) && value.match(/([0-9])/)) strength += 1
    // If it has one special character, increase strength value.  
    if (value.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    // If it has two special characters, increase strength value.  
    if (value.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    // Calculated strength value, we can return messages  
    // If value is less than 2  
    if (strength < 2) {

      errorSpan.html("Passwrod i dobet");
      errorSpan.show();
      makeInvalid(password);
      return false;
    } else if (strength == 2) {
      errorSpan.html("Password i mire");
      errorSpan.show();
      makeValid(password);
      return true;
    } else {
      errorSpan.html("Passwod i forte");
      errorSpan.show();
      makeValid(password)
      return true;
    }
  } else
    return false;

}

function validateDate(element, errorSpan) {
  debugger;
  var data = element.val().trim().split("-");
  var month = parseInt(data[1]);
  var day = parseInt(data[2]);
  var year = parseInt(data[0]);

  if (isNaN(day) || isNaN(month) || isNaN(year)) {
    errorSpan.html("Data nuk eshte e formaitt te sakte");
    errorSpan.show();
    makeInvalid(element);
    return false;
  } else {
    var date = new Date().getFullYear();
    if (year < date - 18 && year > date - 100) {
      errorSpan.hide();
      makeValid(element);
      return true;
    } else {
      errorSpan.html("Jeni i vogel per te perodur programin");
      errorSpan.show();
      makeInvalid(element);
      return true;
    }
  }
}

function checkPostalCode(element, errorSpan) {
  // debugger;
  var regex = new RegExp(/^[0-9]{4}$/);
  var value = element.val().trim();
  if (!regex.test(value)) {
    errorSpan.html("kodi postar nuk eshte i formes se kerkuar");
    errorSpan.show();
    makeInvalid(element);
    return false;
  }
  makeValid(element);
  errorSpan.hide();
  return true;
}

function checkStreet(element, errorSpan) {
  // debugger;
  var regex = new RegExp(/^[a-zA-Z]+.\s*[a-zA-Z]*$/);
  var value = element.val().trim();
  if (!regex.test(value)) {
    errorSpan.html("Rruga nuk eshte e formatit te kerkuar");
    errorSpan.show();
    makeInvalid(element);
    return false;
  }
  makeValid(element);
  errorSpan.hide();
  return true;
}

function checkIfCitySelected(element, errorSpan) {
  debugger;
  if (element.val()) {
    return true;
  } else
    return false;
};