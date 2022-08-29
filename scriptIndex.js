var editButton = document.getElementById('edit-student')
var elementDisplayNone = document.getElementsByClassName('editDisplay')
var searchMenu = document.getElementById('search-menu')
var buttonSearch = document.getElementsByClassName('button-img2')[0]

editButton.addEventListener('click', () => {
    editButton.classList.toggle('active')
    for (let i = 0; i < elementDisplayNone.length; i++) {
        elementDisplayNone[i].classList.toggle('displayNone')
    }
})

buttonSearch.addEventListener('click', ()=>{
    searchMenu.classList.toggle('displayNone')
})