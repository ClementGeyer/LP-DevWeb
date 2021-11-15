var searchbar = document.getElementById('searchBar');

searchbar.addEventListener("keypress", function(e) {
    if(e.key === "Enter"){
        fetch(URLSearchBar, { 
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(e.target.value),
        })
        .then((response) => location.href = response.url);
    }
});

var select = document.getElementById('searchSelect');

select.addEventListener("change", function(e) {
    fetch(URLSearchSelect, {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        method: 'POST',
        body: JSON.stringify(e.target.value),
    })
    .then((response) => location.href = response.url);
});