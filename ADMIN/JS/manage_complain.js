function fillComplainForm(id, user, desc, status, mode) {
    document.getElementById('input_id').value = id;
    document.getElementById('user_name').value = user;
    document.getElementById('complain_text').value = desc;

    if (status === 'Pending') {
        document.getElementById('pending_radio').checked = true;
    } else {
        document.getElementById('resolved_radio').checked = true;
    }

    if (mode === 'update') {
        document.getElementById('update-btn').style.display = 'inline-block';
        document.getElementById('delete-btn').style.display = 'none';
    } else {
        document.getElementById('delete-btn').style.display = 'inline-block';
        document.getElementById('update-btn').style.display = 'none';
    }
}