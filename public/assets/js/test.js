window.addEventListener('load', function () {
    const myFisrtButton = document.querySelector('#btn-dark1');
    const myHeader = document.querySelector('#header');

    myFisrtButton.addEventListener("click", function (){
        myHeader.classList.toggle("dark-mode-header-footer");

        if(myHeader.classList.contains('dark-mode-header-footer')){
            localStorage.setItem('header_theme_dark','dark-mode-header-footer');
        }else{
            localStorage.setItem('header_theme_dark','default');
        }
    });
    function retrieve_dark(){
        let darkHeader = localStorage.getItem('header_theme_dark');

        if(darkHeader != null ){
            myHeader.classList.remove('default', 'dark-mode-header-footer');
            myHeader.classList.add(darkHeader);
        }
    }

    retrieve_dark();

    window.addEventListener("storage",function(){
        //retrieve_funky();
        retrieve_dark();
    },false);
})
