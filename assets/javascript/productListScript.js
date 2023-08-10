function handleIncreasePage() {
    let page = document.querySelector('input[name="page"]');
    let form = document.querySelector("#page-switch");
    page.value = Number(page.value) + 1;
    form.submit();
}

function handleDecreasePage() {
    let page = document.querySelector('input[name="page"]');
    let form = document.querySelector("#page-switch");
    page.value = Number(page.value) - 1;
    form.submit();
}
