(function(){

    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelector(".movie-delete").addEventListener('click', function(e){
            e.preventDefault();
            if(window.confirm("Czy na pewno chesz usunąć ten film?")){
                window.location = e.target.getAttribute("href");
            }
        })
    })

})();