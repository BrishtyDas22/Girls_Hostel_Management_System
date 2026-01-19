function checkNotifications() {
    //  AJAX korar jonno XMLHttpRequest object banano hocche
    var xhr = new XMLHttpRequest();
    
    //  PHP file er location ar POST method set kora hocche
    xhr.open('POST', '../CONTROL/notification_control.php', true);
    
    // Data pathanor jonno header set kora hocche
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // PHP theke jokhon reply ashbe, tokhon eita kaj korbe
    xhr.onreadystatechange = function() {
        // readyState 4 mane kaj shesh, status 200 mane reply thikmoto ashse
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            // PHP theke asha JSON data ke object e convert kora hocche
            var data = JSON.parse(xhr.responseText);
            
            let badge = document.getElementById('noti-badge');
            let list = document.getElementById('noti-list');

            // Koita notification unread (is_read = 0) ota check kora hocche
            let unread = data.filter(function(item) {
                return item.is_read == 0;
            }).length;

            // Jodi unread thake tobe badge dekhabe, nahole hide thakbe
            if (unread > 0) {
                badge.innerText = unread;
                badge.style.display = 'block';
            } else {
                badge.style.display = 'none';
            }

            // Notification list e shob message dekhano
            if (data.length > 0) {
                let html = "";
                data.forEach(function(item) {
                    // Ekta ekta kore message div e dhukano hocche
                    html += '<div class="noti-item">' + item.notifications + '</div>';
                });
                list.innerHTML = html;
            } else {
                list.innerHTML = '<div class="no-noti">Kono notification nai.</div>';
            }
        }
    };

    //  PHP file k bola hocche je amake notification gulo 'fetch' kore dao
    xhr.send('action=fetch');
}

function showNoti() {
    let popup = document.getElementById('noti-popup');
    let badge = document.getElementById('noti-badge');
    
    // Box ta show ba hide korar logic
    if (popup.classList.contains('hidden')) {
        popup.classList.remove('hidden');

        // Click korle lal badge ta muche jabe
        badge.style.display = 'none';

        //  Database e 'is_read = 1' korar jonno arekta AJAX call
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../CONTROL/notification_control.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = JSON.parse(xhr.responseText);
                if(result.status === "success") {
                    // Update hoye gele abar list ta refresh kora hocche
                    checkNotifications();
                }
            }
        };
        // PHP k bola hocche shob read mark koro
        xhr.send('action=mark_read');
    } else {
        // Box khola thakle bondho kora hocche
        popup.classList.add('hidden');
    }
}

// Protigoto 8 second por por automatic check korbe
setInterval(checkNotifications, 8000);

// Page load hobar shomoy prothomei function-ta run hobe
window.addEventListener('load', checkNotifications);