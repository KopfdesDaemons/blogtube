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

    const sidemenuToggle = this.document.querySelector('#blogtube_sidemenu_toggle');
    const sidemenu = this.document.querySelector('#blogtube_sidemenu');
    sidemenuToggle.addEventListener('click', toogleSidemenu);
    sidemenuToggle.addEventListener('keydown', toogleSidemenu)

    let sidemenuIsOpen = false
    function toogleSidemenu() {
        sidemenu.classList.toggle('blogtube_sidemenu_open');
        sidemenu = !sidemenu;
    }

}, false);