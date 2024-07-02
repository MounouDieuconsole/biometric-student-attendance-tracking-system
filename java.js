
//Menu toggle
let toggle= document.querySelector(".toggle");
let navigation= document.querySelector(".navigation");
let main= document.querySelector(".main");

toggle.onclick= function(){
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};

// Alert for adding student
document.addEventListener('DOMContentLoaded', function() {
    var closeAlertBtn = document.getElementById('closeAlert');
    if (closeAlertBtn) {
        closeAlertBtn.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    }
});
       