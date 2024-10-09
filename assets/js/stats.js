let moneySaved = document.getElementById('moneySaved');

fetch('http://127.0.0.1:8000/fake/stats/moneysaved')
    .then(httpResponse => {
        return httpResponse.json();
    })
    .then((result) => {
        console.log(result);
        moneySaved.textContent = result;
    })
    