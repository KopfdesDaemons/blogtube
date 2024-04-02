window.addEventListener("DOMContentLoaded", function () {

    // header mobile submenu toggle
    const header_submenu_toggle = document.querySelectorAll('.blogtube_submenu_toggle');

    for (const toggle of header_submenu_toggle) {
        toggle.addEventListener('click', toggleSubMenu);
        toggle.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                toggleSubMenu(event);
            }
        });
    }

    function toggleSubMenu(event) {
        event.stopPropagation();

        const toggleButton = event.target;
        const listItemContainer = toggleButton.parentElement;
        const listItem = listItemContainer.parentElement;
        const submenu = listItemContainer.parentElement.querySelector('.sub-menu');

        // close all open menus
        const allOpenMenus = document.querySelectorAll('.blogtube_submenu_open');
        const parentListItem = listItem.parentElement.parentElement;
        const isInOpenSubmenu = parentListItem.classList.contains('blogtube_submenu_open');

        if (!isInOpenSubmenu) {
            for (const menu of allOpenMenus) {
                if (menu === submenu.parentElement) continue;
                menu.classList.remove('blogtube_submenu_open');
            }
        }

        listItem.classList.toggle('blogtube_submenu_open');
    }



    // Toggle sidemenu
    const sidemenuToggle = this.document.querySelector('#blogtube_sidemenu_toggle');
    const body = this.document.querySelector('body');
    sidemenuToggle.addEventListener('click', toogleSidemenu);
    sidemenuToggle.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            toogleSidemenu(event);
        }
    });

    function toogleSidemenu() {
        body.classList.toggle('blogtube_sidemenu_open');
    }

    // Closing div (mobile)
    const closingDiv = this.document.querySelector('#blogtube_sidemenu_closing_div');
    closingDiv.addEventListener('click', closeSidemenu)
    function closeSidemenu() {
        console.log("test");
        body.classList.remove('blogtube_sidemenu_open');
    }

}, false);