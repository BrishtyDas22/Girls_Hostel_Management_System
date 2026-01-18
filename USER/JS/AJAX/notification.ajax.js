function loadAllNotifications() {
   
    fetch('../CONTROL/sync_json.php?ajax=true')
    .then(response => response.json())
    .then(data => {
        
        const badge = document.getElementById('notif-badge');
        if (badge) {
            badge.style.display = data.unread > 0 ? 'inline-block' : 'none';
            badge.innerText = data.unread;
        }

       
        const noticeTable = document.getElementById('notice_table_body');
        if (noticeTable) {
            noticeTable.innerHTML = data.notices.map(item => `
                <tr>
                    <td>${item.notification_id}</td>
                    <td>${item.notices}</td>
                </tr>
            `).join('');
        }

     
        const notifContainer = document.getElementById('notif_list_container');
        if (notifContainer) {
            notifContainer.innerHTML = data.notices.map(item => `
                <div class="notif_card ${item.status === 'received' ? 'unread' : ''}">
                    <div class="notif_icon"><img src="../images/notice.gif" width="30"></div>
                    <div class="notif_content">
                        <h4>${item.notification}</h4>
                        <p>Status: ${item.status}</p>
                    </div>
                </div>
            `).join('');
        }
    })
    .catch(error => console.error('Error:', error));
}

setInterval(loadAllNotifications, 5000);
window.onload = loadAllNotifications;