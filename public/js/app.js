// CHANGING THE HEADER COLOR AND SHOWING THE ROP NAV ON WINDOW SCROLL NAVIGATOR
const pageHeader = document.querySelector('#home-header');
window.addEventListener('scroll', () => {
    const pagePosition = window.scrollY + pageHeader.getBoundingClientRect().top;
    if (pagePosition > 56) {
        pageHeader.classList.add('scroll');
    } else {
        pageHeader.classList.remove('scroll');
    }

});


// let error = document.querySelector('.error-card');
// setTimeout(() => { error.style.display = 'none' }, 3000);

// CREATING THE USER MENU TOGGLER
let userMenuToggler = document.querySelector('.user-card');
let userMenu = document.querySelector('.user-menu');
let userMenuUl = document.querySelector('.user-menu ul');

userMenu.addEventListener('mouseover', () => {
    userMenu.classList.add('show');
});
userMenu.addEventListener('mouseout', () => {
    userMenu.classList.remove('show');
});

// Create our number formatter.
var formatter = new Intl.NumberFormat('en-CM', {
    style: 'currency',
    currency: 'USD',

    // These options are needed to round to whole numbers if that's what you want.
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
});

// var amounts = document.getElementsByClassName('amount');
// amounts = Array.from(amounts);
// amounts.forEach(amount => {
//     console.log(amount.textContent.toLocaleString('fr'));
//     amount.textContent = amount.textContent.toLocaleString("en");
// });

let nums = 2500000;
let newNum = [];
let div = document.createElement('div');
nums = nums.toString().split('').reverse().join('').match(/.{1,3}/g).reverse();
nums = nums.forEach(num => {
    num = Number(num.split('').reverse().join(''));
    console.log(num);
    div.append(num + ',');
});
console.log(div.innerText);


// console.log(num[num.length - 1]);



let goalAmounts = document.getElementsByClassName('goal-amounts');
goalAmounts = Array.from(goalAmounts);
goalAmounts.forEach(goalAmount => {
    console.log(goalAmount.textContent);
    let amount = formatter.format(goalAmount.textContent);
    goalAmount.textContent = amount;
});

// SHOWING THE DELETE CAMPAIGN BUTTON
let deleteBtns = document.getElementsByClassName('delete-btn');
let cancelDeleteBtns = document.getElementsByClassName('cancel-delete');
deleteBtns = Array.from(deleteBtns);
cancelDeleteBtns = Array.from(cancelDeleteBtns);
deleteBtns.forEach(deleteBtn => {
    deleteBtn.addEventListener('click', () => {
        deleteBtn.parentElement.children[2].classList.add('show');
        deleteBtn.parentElement.children[3].classList.add('show');
    });
});
cancelDeleteBtns.forEach(cancelDeleteBtn => {
    cancelDeleteBtn.addEventListener('click', () => {
        cancelDeleteBtn.parentElement.children[2].classList.remove('show');
        cancelDeleteBtn.parentElement.children[3].classList.remove('show');
    });
});