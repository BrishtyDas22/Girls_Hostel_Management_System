
function fillFeedbackForm(id, category, comment) {
    // 1. Change form values
    document.getElementsByName('feedback_category')[0].value = category;
    document.getElementsByName('comment')[0].value = comment;
    
    // 2. Add a hidden ID field so the process knows it's an update, not a new post
    let form = document.querySelector('form');
    
    // Remove existing hidden ID if it exists
    let oldId = document.getElementById('edit_feedback_id');
    if(oldId) oldId.remove();

    let idInput = document.createElement('input');
    idInput.setAttribute('type', 'hidden');
    idInput.setAttribute('name', 'feedback_id');
    idInput.setAttribute('id', 'edit_feedback_id');
    idInput.setAttribute('value', id);
    form.appendChild(idInput);

    // 3. Change button name to trigger 'update_feedback' in PHP
    let btn = document.querySelector('.submit-btn');
    btn.setAttribute('name', 'update_feedback');
    btn.innerHTML = 'Update Feedback';
    
    // Scroll to top to see the form
    window.scrollTo(0, 0);
}