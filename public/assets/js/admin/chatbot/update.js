document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-chatbot');
    const editForm = document.querySelector('#editChatbotForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let originalValues = {
        question: '',
        response: ''
    };

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right", 
        timeOut: 2000,
        showMethod: "slideDown", 
        hideMethod: "slideUp",  
        showDuration: 300,     
        hideDuration: 200,      
        extendedTimeOut: 1000           
    };

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const ChatbotID = this.getAttribute('data-id');
            document.getElementById('chatbot_id').value = ChatbotID;
            editForm.action = `/admin/chatbot/update/${ChatbotID}`;

            fetch(`/admin/chatbot/edit/${ChatbotID}`)
                .then(response => response.json())
                .then(data => {
   
                    originalValues.question = data.Question;
                    originalValues.response = data.Response;

                    document.getElementById('edit_question').value = data.Question;
                    document.getElementById('edit_response').value = data.Response;
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Unable to retrieve the question and response. Please try again later.', 'Error');
                });
        });
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault(); 

    
        const currentQuestion = document.getElementById('edit_question').value.trim();
        const currentResponse = document.getElementById('edit_response').value.trim();


        if (currentQuestion === originalValues.question && 
            currentResponse === originalValues.response) {
            toastr.info('No changes detected. Please modify to proceed.', 'Notice');
            return; 
        }

        const formData = new FormData(this);
        fetch(editForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                toastr.success(data.message, 'Updated!');
                $('#editModal').modal('hide');
                
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                toastr.error(data.message, 'Error!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An unexpected error occurred', 'Error!');
        });
    });
});