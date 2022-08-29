var editButton = document.getElementById('edit-student')
var elementDisplayNone = document.getElementsByClassName('editDisplay')

editButton.addEventListener('click', () => {
    editButton.classList.toggle('active')
    for (let i = 0; i < elementDisplayNone.length; i++) {
        elementDisplayNone[i].classList.toggle('displayNone')
    }
})
