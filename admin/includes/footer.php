<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function logout() {
        localStorage.removeItem('user');
        location.href = '../login.php';
    }

    function closeModal() {
        $('#orderModal').addClass('hidden');
    }
</script>
</body>

</html>