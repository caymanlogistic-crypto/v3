(function () {
    let activeButton = null;
    let activePopup = null;

    function closeTooltip() {
        if (activePopup) {
            activePopup.hidden = true;
            activePopup.remove();
            activePopup = null;
        }

        if (activeButton) {
            activeButton.setAttribute('aria-expanded', 'false');
            activeButton = null;
        }
    }

    function createPopup(text) {
        const popup = document.createElement('div');
        popup.className = 'form-help-popup';
        popup.textContent = text;
        popup.hidden = true;
        popup.setAttribute('role', 'tooltip');
        return popup;
    }

    function openTooltip(button) {
        const text = button.getAttribute('data-help');
        if (!text) {
            return;
        }

        if (activeButton === button) {
            closeTooltip();
            return;
        }

        closeTooltip();

        const popup = createPopup(text);
        const wrapper = document.createElement('span');
        wrapper.className = 'form-help';
        button.parentNode.insertBefore(wrapper, button);
        wrapper.appendChild(button);
        wrapper.appendChild(popup);

        popup.hidden = false;
        button.setAttribute('aria-expanded', 'true');

        activeButton = button;
        activePopup = popup;
    }

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.form-help-button');

        if (button) {
            event.preventDefault();
            openTooltip(button);
            return;
        }

        if (activePopup && !activePopup.contains(event.target) && event.target !== activeButton) {
            closeTooltip();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeTooltip();
        }
    });

    window.FormUx = {
        showFormAlert: function (alertNode, message) {
            if (!alertNode) {
                return;
            }
            alertNode.textContent = message;
            alertNode.style.display = 'block';
        },
        hideFormAlert: function (alertNode) {
            if (!alertNode) {
                return;
            }
            alertNode.style.display = 'none';
        },
        closeTooltip: closeTooltip
    };
})();
