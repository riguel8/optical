document.addEventListener('DOMContentLoaded', function () {

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

        const addForm = document.querySelector('#addForm');
        if (addForm) {
            addForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success!');
                        this.reset();
                        $('#addModal').modal('hide');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        toastr.error(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An unexpected error occurred');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                });
            });
        }
    });
  