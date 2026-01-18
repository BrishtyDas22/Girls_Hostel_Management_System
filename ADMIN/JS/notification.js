function checkNotifications() {
    // PHP file theke notification anar jonno AJAX call
    fetch('../CONTROL/notification_control.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=fetch'
    })
    .then(res => res.json()) // Data JSON format-e receive kora
    .then(data => {
        let badge = document.getElementById('noti-badge');
        let list = document.getElementById('noti-list');

        // Shudhu 'is_read = 0' gulo count kora hocche
        let unread = data.filter(item => item.is_read == 0).length;

        // Unread thakle badge-e count dekhabe, nahole hide thakbe
        if (unread > 0) {
            badge.innerText = unread;
            badge.style.display = 'block';
        } else {
            badge.style.display = 'none';
        }

        // List-e shob message thakbe, harabe na
        if (data.length > 0) {
            let html = "";
            data.forEach(item => {
                // Ekhane backtick-er poriborte single quote (') ar plus (+) use kora hoyeche
                html += '<div class="noti-item">' + item.notifications + '</div>';
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
    
    // Notification box show/hide logic
    if (popup.classList.contains('hidden')) {
        popup.classList.remove('hidden');

        // Click korar sathe sathe badge-ta ke display none kora jate phire na ashe
        badge.style.display = 'none';

        // Database-e status 'is_read = 1' korar jonno call
        fetch('../CONTROL/notification_control.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=mark_read'
        })
        .then(res => res.json())
        .then(result => {
            if(result.status === "success") {
                // Confirmly update hole abar checkNotifications call kora hocche
                checkNotifications();
            }
        });
    } else {
        popup.classList.add('hidden');
    }
}

// Protigoto 8 second por por automatic checkDatabase refresh hobe
setInterval(checkNotifications, 8000);

// Page load hobar shomoy prothomei function-ta run hobe
window.addEventListener('load', checkNotifications);