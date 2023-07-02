function handleSubmit(event) {
  event.preventDefault(); // Prevent the form from submitting normally
  const form = event.target;
  const submitButton = form.querySelector('button[type="submit"]');

  // Disable the submit button and show the loading spinner
  submitButton.disabled = true;
  submitButton.innerHTML = `
    <span class="loading loading-spinner"></span>
    Loading
  `;
  // Get the values from the form fields
  var judulAgenda = document.querySelector('input[name="judul_agenda"]').value;
  var isiKegiatan = document.querySelector('input[name="isi_kegiatan"]').value;

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the request
  xhr.open("POST", "./db/form_handler.php", true);
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
  <span>Berhasil! Data berhasil ditambahkan ke database</span>
</div>
          `;
      var modal = document.getElementById("my_modal_2");
      setTimeout(() => {
        // Restore the original button state after the form submission is complete
        submitButton.disabled = false;
        submitButton.innerHTML = "Submit";
      }, 2000);
      modal.close();
      var modalForm = document.getElementById("modal-form");
      modalForm.reset();
      setTimeout(function () {
        insertDataSection.innerHTML = "";
      }, 5000);

      setTimeout(function () {
        location.reload();
      }, 1000);
    } else {
      // Request failed
      console.error("Form submission failed. Error code:", xhr.status);
    }
  };

  // Send the request
  xhr.send("judul_agenda=" + judulAgenda + "&isi_kegiatan=" + isiKegiatan);
}

// Get the modal form element
var modalForm = document.getElementById("modal-form");

// Attach the submit event listener to the modal form
modalForm.addEventListener("submit", handleSubmit);

// Refresh every 5 seconds (5000 milliseconds)
function deleteTask(todoId) {
  $.ajax({
    url: "./db/delete.php",
    type: "POST",
    data: {
      id: todoId,
    },
    success: function () {
      var insertDataSection = document.getElementById("insert-data");
      insertDataSection.innerHTML = `
      <div class="alert alert-error mt-3">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
    </svg>
    
  <span>Deleted! Kegiatan berhasil di hapus.</span>
</div>`;
      setTimeout(function () {
        location.reload();
      }, 1000); // 1000 milliseconds delay (adjust as needed)
      // You can also update the UI to reflect the changes if needed
      // You can also update the UI to reflect the changes if needed
    },
    error: function (xhr, status, error) {
      // Handle the error here
      console.error(error);
    },
  });
}
function completeTask(todoId) {
  $.ajax({
    url: "./db/completed.php",
    type: "POST",
    data: {
      id: todoId,
      isCompleted: 1,
    },
    success: function (response) {
      console.log(response);
      var insertDataSection = document.getElementById("insert-data");
      insertDataSection.innerHTML = `
      <div class="alert alert-info mt-3">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <span>Completed! Kegiatan berhasil diselesaikan</span>
    </div>`;
      setTimeout(function () {
        location.reload();
      }, 1000); // 1000 milliseconds delay (adjust as needed)
      // You can also update the UI to reflect the changes if needed
    },
    error: function (xhr, status, error) {
      // Handle the error here
      console.error(error);
    },
  });
}
let IDid;
function handleFormEdit(title, activity, id) {
  IDid = id;
  var activities = activity;
  var titles = title;
  if (activities != undefined && titles != undefined) {
    document.getElementById("title").value = titles;
    document.getElementById("activity").value = activities;
  } else {
    document.getElementById("title").value = "";
    document.getElementById("activity").value = "";
  }
  // console.log(IDid);
}

function handleEdit() {
  var id = IDid;
  var judulAgenda = document.querySelector('input[name="title"]').value;
  var isiKegiatan = document.querySelector('input[name="activity"]').value;
  $.ajax({
    url: "./db/edit_task.php",
    type: "POST",
    data: {
      id: id,
      title: judulAgenda,
      activity: isiKegiatan,
    },
    success: function (response) {
      // console.log(idTodo);
      var insertDataSection = document.getElementById("insert-data");
      insertDataSection.innerHTML = `
      <div class="alert alert-info mt-3">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      <span>Update! Kegiatan berhasil diedit</span>
    </div>`;
      setTimeout(function () {
        location.reload();
      }, 1000); // 1000 milliseconds delay (adjust as needed)
      // You can also update the UI to reflect the changes if needed
    },
    error: function (xhr, status, error) {
      // Handle the error here
      console.error(error);
    },
  });
}
