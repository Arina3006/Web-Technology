const random = (min, max) => {
    const rand = min + Math.random() * (max - min + 1);
    return Math.floor(rand);
}
const btn = document.querySelector('#btn');
btn.addEventListener('mouseenter', () => {
    btn.style.left = `${random(0,90)}%`;
    btn.style.top = `${random(0,90)}%`;
})

btn.addEventListener('click', () => {
    alert('Уour data has been sent!');
})

function darkmode() {
    const body = document.body
    const wasDarkmode = localStorage.getItem('darkmode') =='true'

    localStorage.setItem('darkmode', !wasDarkmode)
    body.classList.toggle('dark-mode', !wasDarkmode)
}

document.querySelector('.btn_1').addEventListener('click', darkmode)

function onload() {
    document.body.classList.toggle('dark-mode', localStorage.getItem('darkmode') == 'true')
}
document.addEventListener('DOMContentLoaded', onload)