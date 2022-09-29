function togglePopup(userId){

  console.log('user id is = ' + userId)
  document.getElementById("popup-"+userId).classList.toggle("active");
}

