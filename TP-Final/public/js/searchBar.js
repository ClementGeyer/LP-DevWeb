var searchbar = document.getElementById('searchBar');

searchbar.addEventListener("keypress", function(e) {
    if(e.key === "Enter"){
        console.log(e.target.value);
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
})