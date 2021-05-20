const rateIcons = [...document.querySelectorAll('[data-rating=icon]')];
const rateInputs = [...document.querySelectorAll('[id^=rate]')];
let isChecked = false;

const changeStarsType = (currentIconIndex) => {
    if (!isChecked) {
        for (let index = 0; index <= currentIconIndex; index++) {
            rateIcons[index].classList.toggle('far');
            rateIcons[index].classList.toggle('fas');
        }
    }
}

const getCurrentIconId = (currentIcon) => {
    return rateIcons.findIndex(icon => icon === currentIcon);
}

const getCurrentInputId = (activeInput) => {
    return rateInputs.findIndex(input => input === activeInput);
}

rateInputs.forEach(input => {
    input.addEventListener('click', () => {
        isChecked = !isChecked;

        changeStarsType(getCurrentInputId(input));
    });
});

rateIcons.forEach(icon => {
    icon.addEventListener('mouseover', () => changeStarsType(getCurrentIconId(icon)))
    icon.addEventListener('mouseout', () => changeStarsType(getCurrentIconId(icon)))
})

export default { rateIcons, rateInputs };
