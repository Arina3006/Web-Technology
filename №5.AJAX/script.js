var li = document.getElementsByTagName('li')
var cont = document.getElementById('content')

function changeHTML(content) {
    let request = new XMLHttpRequest;
    request.open('GET', content, true)
    request.send()
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
           cont.innerHTML = request.responseText
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