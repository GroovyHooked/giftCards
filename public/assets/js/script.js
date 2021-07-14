window.addEventListener('load', () => {
    let myClock = document.getElementById('myClock');
    let myClockNY = document.getElementById('myClockNY');
    let myClockTK = document.getElementById('myClockTK');
    if (myClock){
        /* Formating function to get 2 digits */
        function formatTime(i) {
            if (i<10) {
                i = "0" + i;
            }
            return i;
        }
        /* Function to show time */
        function startTimeParis() {
            let today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();

            m = formatTime(m);
            s = formatTime(s);
            myClock.innerHTML = h + ":" + m + ":" + s;
            setTimeout(() => { startTimeParis() },500);
        }
        startTimeParis();
        function startTimeNY(){
            let today = new Date();
            let h = today.getHours(today.setHours(today.getHours() - 6))  ;
            let m = today.getMinutes();
            let s = today.getSeconds();

            m = formatTime(m);
            s = formatTime(s);
            myClockNY.innerHTML = h + ":" + m + ":" + s;
            setTimeout(() => { startTimeNY() },500);
        }
        startTimeNY();
        function startTimeTK(){
            let today = new Date();
            let h = today.getHours(today.setHours(today.getHours() + 8))  ;
            let m = today.getMinutes();
            let s = today.getSeconds();

            m = formatTime(m);
            s = formatTime(s);
            myClockTK.innerHTML = h + ":" + m + ":" + s;
            setTimeout(() => { startTimeTK() },500);
        }
        startTimeTK();
    }
    let form = document.getElementById('loginForm');
    /* If element form exist mechanism to enable submit button when inputs are filled */
    if (form) {
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        let bt = document.getElementById('skicka');
        form.addEventListener('input', () => {
            if (email.value.length >= 6 && password.value.length >= 8) {
                bt.removeAttribute('disabled')
            } else {
                bt.setAttribute('disabled', 'disabled')
            }
        })
    }
    let createFrom = document.getElementById('loginFormCreate');
    /* If element createFrom exist mechanism to enable submit button when inputs are filled */
    if (createFrom) {
        let inputs = document.querySelectorAll('input');
        let button = document.getElementById('createButton');

        createFrom.addEventListener('input', () => {
            for(let i = 0; i <= inputs.length; i++){
                let input = inputs[i];
                if(input.value.length > 0){
                    button.removeAttribute('disabled')
                } else {
                    button.setAttribute('disabled', 'disabled')
                }
            }
        });
    }
    /* mechanism to show help when asked for */
    const helpButton = document.getElementById('helpMe');
    if (helpButton){
        const dashHelpButtons = document.querySelectorAll('.hiddenInfos');
        const dashBottomHelpButtons = document.querySelectorAll('.hiddenInfosBottom');
        helpButton.addEventListener('click', ()=> {
            dashHelpButtons.forEach(element => element.classList.toggle('displayHelp'));
            dashBottomHelpButtons.forEach(element => element.classList.toggle('displayHelp'));
            dashBottomHelpButtons.forEach(element => element.classList.toggle('displayBottomHelp'));
            if(helpButton.innerText === 'Aide'){
                helpButton.innerText = 'Fermer';
            } else {
                helpButton.innerText = 'Aide';
            }
        });
    }
    const myFisrtButton = document.querySelector('#btn-dark1');
    const myHeader = document.querySelector('#header');
    const myFooter = document.querySelector('#footer');
    const sousBody = document.querySelector('body');
    const labelButton = document.querySelectorAll('.btn-outline-secondary');
    const otherButton = document.querySelectorAll('.btn-primary');

    myFisrtButton.addEventListener("click", () => {
        myHeader.classList.toggle("dark-mode-header-footer");
        myFooter.classList.toggle('dark-mode-header-footer');
        sousBody.classList.toggle('sousBody-dark');

        labelButton.forEach(element => element.classList.toggle('btn-outline-secondary-dark'));
        otherButton.forEach(element => element.classList.toggle('btn-primary-dark'));

        if (myHeader.classList.contains('dark-mode-header-footer')) {
            localStorage.setItem('header_theme_dark', 'dark-mode-header-footer');
            localStorage.setItem('footer_theme_dark', 'dark-mode-header-footer');
            localStorage.setItem('body_theme_dark', 'sousBody-dark');
            localStorage.setItem('labelButton_dark', 'btn-outline-secondary-dark');
            localStorage.setItem('otherButton_dark', 'btn-primary-dark');

        } else {
            localStorage.setItem('header_theme_dark', 'default');
            localStorage.setItem('footer_theme_dark', 'default');
            localStorage.setItem('body_theme_dark', 'default');
            localStorage.setItem('labelButton_dark', 'default');
            localStorage.setItem('otherButton_dark', 'default');
        }
    });
    /* Function to retrieve the localStorage settings */
    function retrieve_dark() {
        let darkHeader = localStorage.getItem('header_theme_dark');
        let darkFooter = localStorage.getItem('footer_theme_dark');
        let darkBody = localStorage.getItem('body_theme_dark');
        let darklabelB = localStorage.getItem('labelButton_dark');
        let darkotherB = localStorage.getItem('otherButton_dark');

        if (darkHeader != null) {
            myHeader.classList.remove('default', 'dark-mode-header-footer');
            myHeader.classList.add(darkHeader);
            myFooter.classList.remove('default', 'dark-mode-header-footer');
            myFooter.classList.add(darkFooter);
            sousBody.classList.remove('default', 'sousBody-dark');
            sousBody.classList.add(darkBody);
            labelButton.forEach(element => element.classList.remove('default', 'btn-outline-secondary-dark'));
            labelButton.forEach(element => element.classList.add(darklabelB));
            otherButton.forEach(element => element.classList.remove('default', 'btn-primary-dark'));
            otherButton.forEach(element => element.classList.add(darkotherB));
        }
    }
    retrieve_dark();

    window.addEventListener("storage", function () {
        retrieve_dark();
    }, false);
})
