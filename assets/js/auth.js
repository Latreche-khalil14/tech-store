document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const messageDiv = document.getElementById('message');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            hideMessage();
            
            if (tabName === 'login') {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
            } else {
                registerForm.classList.add('active');
                loginForm.classList.remove('active');
            }
        });
    });
    
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        
        try {
            const response = await fetch('api/auth/login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showMessage(data.message, 'success');
                localStorage.setItem('user', JSON.stringify(data.user));
                setTimeout(() => window.location.href = 'index.html', 1000);
            } else {
                showMessage(data.message, 'error');
            }
        } catch (error) {
            showMessage('حدث خطأ في الاتصال', 'error');
        }
    });
    
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const username = document.getElementById('reg-username').value;
        const full_name = document.getElementById('reg-fullname').value;
        const email = document.getElementById('reg-email').value;
        const password = document.getElementById('reg-password').value;
        
        try {
            const response = await fetch('api/auth/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ username, full_name, email, password })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showMessage(data.message, 'success');
                localStorage.setItem('user', JSON.stringify(data.user));
                setTimeout(() => window.location.href = 'index.html', 1000);
            } else {
                showMessage(data.message, 'error');
            }
        } catch (error) {
            showMessage('حدث خطأ في الاتصال', 'error');
        }
    });
    
    function showMessage(message, type) {
        messageDiv.textContent = message;
        messageDiv.className = `message ${type}`;
        messageDiv.style.display = 'block';
    }
    
    function hideMessage() {
        messageDiv.style.display = 'none';
    }
});
