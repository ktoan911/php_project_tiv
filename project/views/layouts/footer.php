        </div>
        </main>

        <footer class="footer">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Made by ktoan911</p>
            </div>
        </footer>

        <script>
            // Tự động ẩn thông báo sau 5 giây
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.display = 'none';
                });
            }, 5000);
        </script>
        </body>

        </html>