let formUser = document.querySelector('#form-user');
let msgContainer = document.querySelector('.form-message');
let requiredField = document.querySelectorAll('#form-user .required');
let emailField = document.querySelector('#form-user .email');
let messageSuccess = 'formulaire envoyer';


formUser.addEventListener('submit', async (e)=>{
    let canSend = true;
    let messageError = '';
    e.preventDefault();
    // field are empty
    for (const field of requiredField) {

        msgContainer.innerHTML = '';
        field.classList.remove('error');

        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if(field == emailField && !regexEmail.test(field.value)) {
            field.classList.add('error');
            messageError = 'un ou plusieurs champ(s) invalid(s)';
            canSend = false
        }

        if (field.value.trim().length === 0) {
            field.classList.add('error');
            messageError = 'un ou plusieurs champ(s) vide(s)';
            canSend = false
        } 
    }

    if (!canSend) {
        msgContainer.innerHTML = messageError;
        return false;
    } else {
        msgContainer.classList.remove('alert');
        msgContainer.classList.add('success');
        msgContainer.innerHTML = messageSuccess;
        // reset html
        msgContainer.classList.add('alert');
        let formData = new FormData(formUser);
        await ajax('/franklin/form.php', formData)
        // setTimeout(() => {
        //     msgContainer.innerHTML = '';
        // }, 5000);
    }

})