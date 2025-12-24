document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    
    // Tab Switching Logic
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            if (tabName === 'login') {
                if (loginForm) loginForm.classList.add('active');
                if (registerForm) registerForm.classList.remove('active');
            } else {
                if (registerForm) registerForm.classList.add('active');
                if (loginForm) loginForm.classList.remove('active');
            }
        });
    });
    
    // Global ShowMessage function (using Swal Toast)
    window.showMessage = function(message, type) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: message,
                icon: type,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        } else {
            alert(message);
        }
    };

    // Login Submission
    const loginFormElement = document.getElementById('loginForm');
    if (loginFormElement) {
        loginFormElement.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            try {
                const response = await fetch('../backend/api/auth/login.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const user = data.data.user;
                    showMessage(data.message, 'success');
                    localStorage.setItem('user', JSON.stringify(user));
                    
                    const returnUrl = localStorage.getItem('returnUrl');
                    if (returnUrl) {
                        localStorage.removeItem('returnUrl');
                        setTimeout(() => window.location.href = returnUrl, 1500);
                    } else if (user.role === 'admin') {
                        setTimeout(() => window.location.href = '../backend/admin/index.php', 1500);
                    } else {
                        setTimeout(() => window.location.href = 'index.php', 1500);
                    }
                } else {
                    showMessage(data.message, 'error');
                }
            } catch (error) {
                showMessage('حدث خطأ في الاتصال بالسيرفر', 'error');
            }
        });
    }
    
    // Registration Submission
    const registerFormElement = document.getElementById('registerForm');
    if (registerFormElement) {
        registerFormElement.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const username = document.getElementById('reg-username').value;
            const full_name = document.getElementById('reg-fullname').value;
            const email = document.getElementById('reg-email').value;
            const phone = document.getElementById('reg-phone').value;
            const password = document.getElementById('reg-password').value;
            
            try {

                const response = await fetch('../backend/api/auth/register.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username, full_name, email, password, phone })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const user = data.data.user;
                    showMessage(data.message, 'success');
                    localStorage.setItem('user', JSON.stringify(user));
                    
                    const returnUrl = localStorage.getItem('returnUrl');
                    if (returnUrl) {
                        localStorage.removeItem('returnUrl');
                        setTimeout(() => window.location.href = returnUrl, 1500);
                    } else {
                        setTimeout(() => window.location.href = 'index.php', 1500);
                    }
                } else {
                    showMessage(data.message, 'error');
                }
            } catch (error) {
                showMessage('حدث خطأ أثناء الاتصال بالسيرفر', 'error');
            }
        });
    }
});
