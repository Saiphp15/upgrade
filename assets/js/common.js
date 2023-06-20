$(document).ready(function () {
    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/upgrade';        
    }else{
        base_url = '/upgrade';
    }    
    
    $('.numberonly').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
        return false;
    });

     /* Flat Number Only Validation */
     $('.floatNumberOnly').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9-.]/g))
        return false;
    });
    
    /* Disable right-click */
    document.addEventListener('contextmenu', (e) => e.preventDefault());

    function ctrlShiftKey(e, keyCode) {
        return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
    }

    document.onkeydown = (e) => {
        /* Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U */
        if (
            event.keyCode === 123 ||
            ctrlShiftKey(e, 'I') ||
            ctrlShiftKey(e, 'J') ||
            ctrlShiftKey(e, 'C') ||
            (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        )
        return false;
    };
    
});




  
