var canLoad = true;
var page = 2;
var allResultsLoaded = false;

window.addEventListener('scroll', function() {
    if (canLoad && !allResultsLoaded && window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
        canLoad = false;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', my_scripts_vars.ajaxurl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

        xhr.onload = function() {
            if (xhr.status === 200) {
                canLoad = true;
                if (xhr.responseText.trim()) { // Check that the content is not empty
                    document.getElementById('blogtube_main_content').insertAdjacentHTML('beforeend', xhr.responseText);
                    page++;
                } else {
                    allResultsLoaded = true;
                }
            }
        };

        xhr.send('action=load_posts&page=' + page);
    }
});
