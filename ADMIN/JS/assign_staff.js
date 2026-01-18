function fillStaffForm(id, name, complain, mode) {
    document.getElementById('staff_id').value = id;
    document.getElementById('staff_name').value = name;
    document.getElementById('complain_id').value = complain;

    // Ei line-ti 'Assign Staff' button hide korbe
    document.getElementById('add-btn').style.display = 'none';
    
    if (mode === 'update') {
        document.getElementById('update-btn').style.display = 'inline-block';
        document.getElementById('delete-btn').style.display = 'none';
    } else if (mode === 'delete') {
        document.getElementById('delete-btn').style.display = 'inline-block';
        document.getElementById('update-btn').style.display = 'none';
    }
}

function validateAction(type) {
    if (document.getElementById('staff_id').value == "") {
        alert("Select a record first!");
        return false;
    }
    return confirm("Are you sure you want to " + type + " this?");
}