function loginUser() {
    var formData = $('#nform').serialize();
    
    $.ajax({
      type: 'POST',
      url: 'php/login.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
      if(data.success) {
        window.location.replace("profile.html");
        alert('Login successful!');
      } else {
        alert(data.error);
      }
    });
  }
  
  $(document).ready(function() {
    $('#nform').submit(function(event) {
      event.preventDefault();
      loginUser();
    });
  });