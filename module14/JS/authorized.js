const tooltip = document.querySelector('.tooltip--authorized');
const headerUserButton = document.querySelector('.account');
const logoutButton = document.querySelector('#logout--button');

headerUserButton.addEventListener('click', () => {
    if (tooltip.style.visibility == 'hidden') {
        tooltip.style.visibility = 'visible';
    } else {
        tooltip.style.visibility = 'hidden';
    }
});

// // проверяем дату рождения

// // создаем класс, которые вернет день и месяц в формате, подходящим для сравнения с данными из сессии
// class CurrentDate {
//     constructor(date, day, month) {
//         this.date = new Date();
//         this.day = this.date.getDate();
//         this.month = this.date.getMonth();
//     }

//     addZero(value) {
//         if (value < 10) {
//             return '0' + value.toString();
//         } else {
//             return value.toString();
//         }
//     }

//     getDay() {
//         return this.addZero(this.day);
//     }

//     getMonth() {
//         const month = this.month + 1; // в Date() отсчет месяцев начинается с нуля, в отличие от php
//         return this.addZero(month);
//     }
// }

// const d = new CurrentDate;