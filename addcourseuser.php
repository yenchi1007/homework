<script>
    document.getElementById('memberForm').addEventListener('submit', function (event) {
        event.preventDefault(); // 防止表單的預設提交行為

        const name = document.getElementById('memberName').value;
        const role = document.getElementById('memberRole').value;
        const password = document.getElementById('memberPassword').value;

        // 檢查表單欄位是否填寫完整
        if (!name || !role || !password) {
            alert('請填寫完整的會員資訊！');
            return;
        }

        // 發送新增會員請求
        fetch('addUser.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&role=${role}&password=${encodeURIComponent(password)}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('新增成功！');
                    location.reload(); // 新增成功後重新加載頁面
                } else {
                    alert('新增失敗：' + data.message);
                }
            })
            .catch(error => {
                console.error('發生錯誤:', error);
                alert('發生錯誤，請稍後再試！');
            });
    });
</script>
