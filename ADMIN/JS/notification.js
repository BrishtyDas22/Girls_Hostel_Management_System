function checkNotifications() {
    fetch('../CONTROL/notification_control.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=fetch'
    })
    .then(res => res.json())
    .then(data => {
        let badge = document.getElementById('noti-badge');
        let list = document.getElementById('noti-list');

        // Shudhu unread gulo check kora
        let unread = data.filter(item => item.is_read == 0).length;

        // Jodi unread thake tobei badge dekhabe
        if (unread > 0) {
            badge.innerText = unread;
            badge.style.display = 'block';
        } else {
            badge.style.display = 'none';
        }

        if (data.length > 0) {
            let html = "";
            data.forEach(item => {
                html += `<div class="noti-item">${item.notifications}</div>`;
            });
            list.innerHTML = html;
        } else {
            list.innerHTML = '<div class="no-noti">No notifications found.</div>';
        }
    });
}

function showNoti() {
    let popup = document.getElementById('noti-popup');
    let badge = document.getElementById('noti-badge');
    
    if (popup.classList.contains('hidden')) {
        popup.classList.remove('hidden');

        // 1. Sathe sathe badge hide kora (jodi phire na ashe)
        badge.style.display = 'none';

        // 2. Database update kora
        fetch('../CONTROL/notification_control.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=mark_read'
        })
        .then(res => res.json())
        .then(result => {
            if(result.status === "success") {
                // Confirmly database update hoyeche, ekhon refresh fetch
                checkNotifications();
            }
        });
    } else {
        popup.classList.add('hidden');
    }
}

// 8 second por por automatic update
setInterval(checkNotifications, 8000);
window.addEventListener('load', checkNotifications);