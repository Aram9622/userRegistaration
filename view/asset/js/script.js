let element = document.getElementById('phone');
let maskOptions = {
    mask: '(000) 000-0000'
};
let mask = IMask(element, maskOptions);

function clearSession(){
    let allSelector = document.querySelectorAll('.text-danger');

    if(allSelector.length >= 1){
        setTimeout(()=>{
            fetch("/user.php?action=errorSessionClear")

            allSelector.forEach((elem)=>{
                elem.parentElement.remove();
            })
        }, 3000)
    }


}