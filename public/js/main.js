/**
 * Plik zawiera wszystkie pliki javascriptu potrzebne do obsługi naszej aplikacji
 */
(function(){

    document.addEventListener('DOMContentLoaded', (event) => {
        
        /**
         * Funkcja odpowiadająca za potwierdzenie usunięcia pliku.
         */
        document.querySelector(".movie-delete").addEventListener('click', function(e){
            e.preventDefault();
            if(window.confirm("Czy na pewno chesz usunąć ten film?")){
                window.location = e.target.getAttribute("href");
            }
        })
    })

})();