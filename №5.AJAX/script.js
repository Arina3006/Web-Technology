var li = document.getElementsByTagName('li')
var cont = document.getElementById('content')

function changeHTML(content) {
    let request = new XMLHttpRequest;
    request.open('GET', content, true)
    request.send()
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
           cont.innerHTML = request.responseText
           localStorage.setItem('key', request.responseText)
        }
    }
}

li[0].onclick = () => {
    changeHTML('film.html')
}

li[1].onclick = () => {
    changeHTML('about.html')
}

li[2].onclick = () => {
    changeHTML('actor.html')
}
li[3].onclick = () => {
    changeHTML('main.html')
}

function onload() {
    cont.innerHTML=localStorage.getItem('key')
}
document.addEventListener('DOMContentLoaded', onload)