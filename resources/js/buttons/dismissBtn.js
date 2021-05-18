const btnsList = document.querySelectorAll('[data-dismiss="alert"]');

btnsList.forEach(btn => {
    btn.addEventListener('click', function () {
        this.parentNode.remove();
    });
});

export default btnsList;
