function showSaves(value){
    if(value=="הוספה לחיסכון") {
       
        document.getElementById('saves').style.display="block"
        
    }
    if(value=="הוצאה" || value=="הכנסה" ||value=="הוצאה קבועה" || value=="הכנסה קבועה" ) {
        document.getElementById('saves').style.display="none"
        
    }
}

function confirmDelete(){
    const checkbox = document.getElementById('confirmToDelete')
    checkbox.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            document.getElementById('deleteGroup').disabled=false
        } else {
            
            document.getElementById('deleteGroup').disabled=true
           }
      })   
   
}

function confirmUpdate(){
    const checkbox = document.getElementById('confirmToUpdate')
    checkbox.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            document.getElementById('last_name').disabled=false
            document.getElementById('first_name').disabled=false
            document.getElementById('phone').disabled=false
            document.getElementById('submit').disabled=false
        } else {
            
            document.getElementById('last_name').disabled=true
            document.getElementById('first_name').disabled=true
            document.getElementById('phone').disabled=true
            document.getElementById('submit').disabled=true
           }
      })

}

function tooltipEnable() {
    $('[data-toggle="tooltip"]').tooltip()
  }


  // Progress Bar --------------------->
  $(function() {

    $(".progress").each(function() {
  
      var value = $(this).attr('data-value');
      var left = $(this).find('.progress-left .progress-bar');
      var right = $(this).find('.progress-right .progress-bar');
  
      if (value > 0) {
        if (value <= 50) {
          right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
        } else {
          right.css('transform', 'rotate(180deg)')
          left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
        }
      }
  
    })
  
    function percentageToDegrees(percentage) {
  
      return percentage / 100 * 360
  
    }
  
  });
  // Carousel into transaction page
  function carouselEnable() {
    $('.carousel').carousel()
  }

  // for Aout Page
  $(function() {
    /* Rounded Dots Dark */
    $("#content-1").mCustomScrollbar({
      theme: "rounded-dots-dark"
    });
  
    /* Rounded Dark */
    $("#content-2").mCustomScrollbar({
      theme: "rounded-dark"
    });
  
    /* Inset Dark */
    $("#content-3").mCustomScrollbar({
      theme: "inset-3-dark"
    });
  
    /* 3d Dark */
    $("#content-4").mCustomScrollbar({
      theme: "3d-dark"
    });
  
    /* Dark Thin */
    $("#content-5").mCustomScrollbar({
      theme: "dark-thin"
    });
  });


