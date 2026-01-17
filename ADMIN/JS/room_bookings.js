function fillBooking(btn, mode) {
    // Select the table row where the button was clicked
    var row = btn.parentElement.parentElement;
    
    // Get values directly from table cells 
    var b_id = row.cells[0].innerText;
    var u_name = row.cells[1].innerText;
    var r_num = row.cells[2].innerText;
    var t_num = row.cells[3].innerText;
    var p_method = row.cells[4].innerText;
    var t_id = row.cells[5].innerText;
    var status = row.cells[6].innerText.trim();

    // Fill the form input fields
    document.getElementById('booking_id').value = b_id;
    document.getElementById('username').value = u_name;
    document.getElementById('room_num').value = r_num;
    document.getElementById('t_num').value = t_num;
    document.getElementById('t_id').value = t_id;

    // Handle Payment Method Radio Buttons
    if (p_method === 'Bkash') {
        document.getElementById('bkash').checked = true;
    } else if (p_method === 'Nagad') {
        document.getElementById('nagad').checked = true;
    }

    // Handle Status Radio Buttons
    if (status === 'Pending') {
        document.getElementById('pending').checked = true;
    } else if (status === 'Approved') {
        document.getElementById('approved').checked = true;
    }

    // changing   button visibility based on mode
    document.getElementById('add-btn').style.display = 'none';
    
    if (mode === 'update') {
        document.getElementById('update-btn').style.display = 'inline-block';
        document.getElementById('delete-btn').style.display = 'none';
    } else if (mode === 'delete') {
        document.getElementById('update-btn').style.display = 'none';
        document.getElementById('delete-btn').style.display = 'inline-block';
    }
}