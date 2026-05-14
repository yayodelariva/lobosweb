/**
 * On the Jugador edit screen: show numero_foam if any "foam-*" equipo term is
 * ticked, and numero_cloth if any "cloth-*" equipo term is ticked. The labels
 * (e.g. "Foam Varonil") are used to detect prefix.
 */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        var tax = document.getElementById('equipochecklist');
        if (!tax) return;

        function fieldWrap(name) {
            return document.querySelector('.acf-field[data-name="' + name + '"]');
        }

        var foamField  = fieldWrap('numero_foam');
        var clothField = fieldWrap('numero_cloth');

        function anyChecked(prefix) {
            return Array.prototype.some.call(
                tax.querySelectorAll('label'),
                function (label) {
                    var input = label.querySelector('input[type=checkbox]');
                    if (!input || !input.checked) return false;
                    return label.textContent.trim().toLowerCase().indexOf(prefix) === 0;
                }
            );
        }

        function sync() {
            if (foamField)  foamField.style.display  = anyChecked('foam')  ? '' : 'none';
            if (clothField) clothField.style.display = anyChecked('cloth') ? '' : 'none';
        }

        sync();
        tax.addEventListener('change', sync);
    });
})();
