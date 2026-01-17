function fillFeedbackForm(id, username, reply, mode) {
    // Input field-e data boshano
    document.getElementById('f_id').value = id;
    document.getElementById('username').value = username;
    document.getElementById('reply').value = reply;

    // Save Reply ebong Delete Row button change kora kora
    // Mode 'update' hole Save Reply show korbe, 'delete' hole Delete Row show korbe
    document.getElementById('update-btn').style.display = (mode === 'update') ? 'inline-block' : 'none';
    document.getElementById('delete-btn').style.display = (mode === 'delete') ? 'inline-block' : 'none';
    
   
}

// Cancel button click korle
function resetFeedbackForm() {
    document.getElementById('f_id').value = "";
    document.getElementById('username').value = "";
    document.getElementById('reply').value = "";
    document.getElementById('update-btn').style.display = 'none';
    document.getElementById('delete-btn').style.display = 'none';
}