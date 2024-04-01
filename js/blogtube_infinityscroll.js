var canLoad = true;
var page = 2; // Initial page number
var allResultsLoaded = false; // Variable, um den Status der Suchergebnisse zu verfolgen

window.addEventListener('scroll', function() {
    // Überprüfen, ob das Laden möglich ist und ob nicht alle Suchergebnisse bereits geladen wurden
    if (canLoad && !allResultsLoaded && window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
        canLoad = false;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', my_scripts_vars.ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

        xhr.onload = function() {
            if (xhr.status === 200) {
                canLoad = true;
                if (xhr.responseText.trim() !== 'NoMorePosts') {
                    document.getElementById('blogtube_main_content').insertAdjacentHTML('beforeend', xhr.responseText);
                    page++;
                } else {
                    // Alle Suchergebnisse wurden geladen
                    allResultsLoaded = true;
                }
            }
        };

        xhr.send('action=load_posts&page=' + page);
    }
});
