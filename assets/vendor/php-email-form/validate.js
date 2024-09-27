(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach(function(e) {
      e.addEventListener('submit', function(event) {
          event.preventDefault();

          let thisForm = this;
          let action = thisForm.getAttribute('action');

          if (!action) {
              displayError(thisForm, 'The form action property is not set!');
              return;
          }

          thisForm.querySelector('.loading').classList.add('d-block');
          thisForm.querySelector('.error-message').classList.remove('d-block');
          thisForm.querySelector('.sent-message').classList.remove('d-block');

          let formData = new FormData(thisForm);
          submitForm(thisForm, action, formData);
      });
  });

  function submitForm(thisForm, action, formData) {
      fetch(action, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          if (response.ok) {
              return response.json();
          } else {
              throw new Error(`${response.status} ${response.statusText}`);
          }
      })
      .then(data => {
          thisForm.querySelector('.loading').classList.remove('d-block');
          if (data.status === 'success') {
              thisForm.querySelector('.sent-message').classList.add('d-block');
              thisForm.reset();
          } else {
              throw new Error('Form submission failed: ' + data.message);
          }
      })
      .catch(error => {
          displayError(thisForm, 'Error: ' + error.message);
      });
  }

  function displayError(thisForm, error) {
      thisForm.querySelector('.loading').classList.remove('d-block');
      thisForm.querySelector('.error-message').innerHTML = error;
      thisForm.querySelector('.error-message').classList.add('d-block');
  }
})();
