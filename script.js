function handleSubmit(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get the values from the form fields
  var judulAgenda = document.querySelector('input[name="judul_agenda"]').value;
  var isiKegiatan = document.querySelector('input[name="isi_kegiatan"]').value;

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the request
  xhr.open("POST", "form_handler.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Set up the callback function for when the request completes
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Request was successful
      console.log("Form submission successful!");
      console.log("Response:", xhr.responseText);
      // Update the HTML content with the form data
      var insertDataSection = document.getElementById("insert-data");
      insertDataSection.innerHTML = `
        <div class="mt-3  alert alert-success">
<svg xmlns="http://www.w3.org/2000/svg" class="hidden md:flex stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
<span>Data berhasil ditambahkan ke database!</span>
</div>
        `;
      var modal = document.getElementById("my_modal_2");
      modal.close();
      var modalForm = document.getElementById("modal-form");
      modalForm.reset();
      setTimeout(function () {
        insertDataSection.innerHTML = "";
      }, 5000);
    } else {
      // Request failed
      console.error("Form submission failed. Error code:", xhr.status);
    }
  };

  // Prepare the form data to send
  var formData = new FormData();
  formData.append("judul_agenda", judulAgenda);
  formData.append("isi_kegiatan", isiKegiatan);

  // Send the request
  xhr.send(formData);
}

// Get the modal form element
var modalForm = document.getElementById("modal-form");

// Attach the submit event listener to the modal form
modalForm.addEventListener("submit", handleSubmit);
