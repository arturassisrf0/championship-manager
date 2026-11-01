        (function () {
            'use strict';

            var form = document.getElementById('login-form');
            if (!form) return;

            var email = document.getElementById('email');
            var senha = document.getElementById('senha');
            var toggle = document.getElementById('toggle-senha');
            var btn = document.getElementById('btn-login');
            var btnLabel = btn.querySelector('.btn-label');
            /* ---------- Mostrar/esconder senha ---------- */
            toggle.addEventListener('click', function () {
                var showing = senha.type === 'text';
                senha.type = showing ? 'password' : 'text';
                toggle.setAttribute('aria-pressed', String(!showing));
                toggle.setAttribute('aria-label', showing ? 'Mostrar senha' : 'Esconder senha');
                toggle.firstElementChild.className = showing ? 'bi bi-eye' : 'bi bi-eye-slash';
            });

            /* ---------- Validação visual básica ---------- */
            function validate(input) {
                var ok = input.value.trim() !== '' && input.checkValidity();
                input.classList.toggle('is-invalid', !ok);
                input.classList.toggle('is-valid', ok);
                input.setAttribute('aria-invalid', String(!ok));
                return ok;
            }

            // Valida ao sair do campo; depois, corrige em tempo real
            [email, senha].forEach(function (input) {
                input.addEventListener('blur', function () { if (input.value !== '') validate(input); });
                input.addEventListener('input', function () {
                    if (input.classList.contains('is-invalid') || input.classList.contains('is-valid')) validate(input);
                });
            });

            /* ---------- Estado de carregamento (reutilizável) ---------- */
            // Use setLoading(true) ao enviar e setLoading(false) se houver erro.
            function setLoading(isLoading) {
                btn.classList.toggle('is-loading', isLoading);
                btn.disabled = isLoading;
                btn.setAttribute('aria-busy', String(isLoading));
                btnLabel.textContent = isLoading ? 'Entrando...' : 'Entrar';
            }
            window.setLoginLoading = setLoading;

            form.addEventListener('submit', function (event) {
                var emailOk = validate(email);
                var senhaOk = validate(senha);

                if (!emailOk || !senhaOk) {
                    event.preventDefault();
                    (emailOk ? senha : email).focus();
                    return;
                }

                setLoading(true);
            });
        })();
