
function fillFeedbackForm(id, category, comment) {

    document.getElementsByName('feedback_category')[0].value = category;
    document.getElementsByName('comment')[0].value = comment;
  
    let form = document.querySelector('form');
    
    
    let oldId = document.getElementById('edit_feedback_id');
    if(oldId) oldId.remove();

    let idInput = document.createElement('input');
    idInput.setAttribute('type', 'hidden');
    idInput.setAttribute('name', 'feedback_id');
    idInput.setAttribute('id', 'edit_feedback_id');
    idInput.setAttribute('value', id);
    form.appendChild(idInput);


    let btn = document.querySelector('.submit-btn');
    btn.setAttribute('name', 'update_feedback');
    btn.innerHTML = 'Update Feedback';
    
    window.scrollTo(0, 0);
}