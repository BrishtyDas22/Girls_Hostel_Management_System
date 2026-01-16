function fillStudentForm(name, email, phone, blood, pass, c_pass, mode) {
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('blood').value = blood;
    document.getElementById('password').value = pass;
    document.getElementById('c_password').value = c_pass;

    document.getElementById('add-btn').style.display = 'none'; 
    document.getElementById('update-btn').style.display = (mode === 'update') ? 'inline-block' : 'none';
    document.getElementById('delete-btn').style.display = (mode === 'delete') ? 'inline-block' : 'none';
}

function validateAction(type) {
    if (document.getElementById('email').value == "") {
        alert("Select a student first!");
        return false;
    }
    return confirm("Are you sure you want to " + type + " this student?");
}