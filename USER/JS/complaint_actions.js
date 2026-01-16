function confirmDelete(cid) {
    if (confirm("Are you sure you want to delete this complaint?")) {
        window.location.href = "../CONTROL/complaintprocess.php?delete_id=" + cid;
        return true;
    }
    return false;
}


function editComplaint(id, category, description) {
    
    document.getElementById('edit_cid').value = id;
    
   
    document.querySelector('select[name="category"]').value = category;
   
    document.querySelector('textarea[name="description"]').value = description;
    
   
    document.getElementById('submit-btn').innerText = "Update Complaint";
    document.getElementById('submit-btn').name = "update_complaint";
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}