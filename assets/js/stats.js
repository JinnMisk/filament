let moneySaved = document.getElementById('moneySaved');

fetch('https://127.0.0.1:8000/fake/stats/moneysaved')
    .then(httpResponse => {
        return httpResponse.json();
    })
    .then((result) => {
        console.log(result);
        moneySaved.textContent = result;
    })
    