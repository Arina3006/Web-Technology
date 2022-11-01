const random = (min, max) => {
    //функция рандома
    const rand = min + Math.random() * (max - min + 1);
    return Math.floor(rand);
    // возвращаем случайное целое число внутри определенного диапазона
}
const btn = document.querySelector('#btn');
// находим кнопку btn из документа
btn.addEventListener('mouseenter', () => {
    //обработчик событий, события генерируются курсором мыши
    btn.style.left = `${random(0,90)}%`;
    // кнопка может перемещается в лево на 90% экрана
    btn.style.top = `${random(0,90)}%`;
    // кнопка перемещается на 90% в высоту экрана
})
//
btn.addEventListener('click', () => {
    alert('Уour data has been sent!');
})
// в случае победы(нажатия) выводится сообщение


function darkmode() {
    //создали функцию
    const body = document.body
    //получаем body(обращаемся к нему)
    const wasDarkmode = localStorage.getItem('darkmode') =='true'
    //получить значение, мы будем брать darkmode при значении "правда"

    localStorage.setItem('darkmode', !wasDarkmode)
    //устанавливаем значение darkmod, которое противоположно предыдущему значению
    body.classList.toggle('dark-mode', !wasDarkmode)
    //берем элемент бади используем метод с указанием класса, которым мы манипулируем.
    //Он будет зависеть от противоположного значения, как в предыдущем действии
}

document.querySelector('.btn_1').addEventListener('click', darkmode)
//вызвали метод который происходит, когда кликнули на элемент левой кнопкой мыши 
function onload() {
    document.body.classList.toggle('dark-mode', localStorage.getItem('darkmode') == 'true')
    //берем элемент бади используем метод с указанием класса, которым мы манипулируем.
}
document.addEventListener('DOMContentLoaded', onload)
//функция с помощью которой при обновлении страницы остается тема, выбранная последний раз