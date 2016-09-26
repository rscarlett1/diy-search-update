var usernamePattern = new RegExp("^[a-zA-Z0-9._-]{3,20}$");
var namePattern = RegExp("^[A-Za-z' .-]{1,30}$");
var lastNamePattern = RegExp("^[A-Za-z' .-]{1,30}$");
var phoneNumberPattern = RegExp("^[0-9()+]{1,17}$");
var emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var mobileNumberPattern = RegExp("^[0-9()+]{1,17}$");
var pricePattern = RegExp("^[0-9$.]{1,10}$");