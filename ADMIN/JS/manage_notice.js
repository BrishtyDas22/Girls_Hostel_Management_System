function fillNoticeForm(id, user, desc, mode) {
    document.getElementById('notice_id').value = id;
    document.getElementById('username').value = user;
    document.getElementById('description').value = desc;

    document.getElementById('add-btn').style.display = 'none';
    document.getElementById('update-btn').style.display = (mode === 'update') ? 'inline-block' : 'none';
    document.getElementById('delete-btn').style.display = (mode === 'delete') ? 'inline-block' : 'none';
}

function validateAction(type) {
    if (document.getElementById('notice_id').value == "") {
        alert("Please select a notice first!");
        return false;
    }
    return confirm("Are you sure you want to " + type + " this notice?");
}