const searchBar = document.querySelector('.users .search input');
const searchBtn = document.querySelector('.users .search button');
const usersList = document.querySelector('.users .users-list');

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}
searchBar.onkeyup = () =>{
    var searchItem = searchBar.value;

    if(searchItem != ""){
        searchBar.classList.add("active");
    }
    else{
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("POST", "ajax/search.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchItem);
}
setInterval(() => {
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open("GET", "ajax/users.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500);