
function fillForm(room_num, price, type, capacity, student, mode) {
    //input field e value bosano
    document.getElementById('room_no').value = room_num;
    document.getElementById('price').value = price;
    document.getElementById('capacity').value = capacity;
    document.getElementById('present_student').value = student;
    
 
    if (type === 'AC')
        
        { 
        document.getElementById('ac').checked = true; 
    } 
    else
        
        { 
        document.getElementById('non_ac').checked = true; 
    }

    
    var addBtn = document.getElementById('add-btn');
    var updateBtn = document.getElementById('update-btn');
    var deleteBtn = document.getElementById('delete-btn');
    var cancelBtn = document.getElementById('cancel-btn');

   
    addBtn.style.display = 'none';
    

    updateBtn.style.display = 'none';
    deleteBtn.style.display = 'none';

    if (mode === 'update') 
        {
        updateBtn.style.display = 'inline-block';
    } 
    else if (mode === 'delete') 
        
        {
        deleteBtn.style.display = 'inline-block';
    }
    

    cancelBtn.style.display = 'inline-block';
}


function validateAction(type) {
    var room = document.getElementById('room_no').value;
    if (room == "") {
        alert("Please select a room from the table first!");
        return false;
    }
    return confirm("Are you sure you want to " + type + " this room?");
}