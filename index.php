<?php
require './db/query.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>TodoList</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>

</head>

<body class="w-[90%] mx-auto">
  <dialog id="my_modal_2" class="modal">
    <form id="modal-form" class="modal-box">
      <div class="flex flex-col justify-center items-center">
        <h3 class="font-bold text-lg mb-5">
          Apa yang akan kamu lakukan hari ini?
        </h3>
        <input type="text" placeholder="Judul Agenda" required class="input mb-5 input-bordered input-sm input-error w-full max-w-xs" name="judul_agenda" />
        <input type="text" placeholder="Isi kegiatan" required class="input input-bordered mb-5 input-sm input-error w-full max-w-xs" name="isi_kegiatan" />
        <button type="submit" onclick="todoId(null)" class="btn text-blue-500">Submit</button>
      </div>
    </form>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
  <nav>
    <!-- Add your navigation menu here -->
    <ul class="flex flex-wrap justify-between items-center px-3 mt-5">
      <div>
        <div class="stat">
          <div class="stat-value text-secondary">TodoList</div>
        </div>
      </div>

      <button class="hidden md:flex btn" onclick="my_modal_2.showModal()">
        <p class="text-yellow-300">Tambah data</p>
      </button>
      <button class="md:hidden" onclick="my_modal_2.showModal()" class="">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-yellow-400">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
      <div>
        <div class="stat">
          <div class="stat-figure text-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
          </div>
          <div class="stat-title">Ongoing Todo</div>
          <div class="stat-value text-secondary"><?php echo $totalRows ?> </div>
          <div class="stat-desc">Total yang tersimpan di database</div>
        </div>
      </div>

    </ul>
    <p class="border-b-2 text-transparent border-white">header</p>
  </nav>

  <main cl>
    <section id="insert-data" class=""></section>
    <section id="stat" class="flex justify-center items-center mt-3 mb-2">
      <div class="stats shadow">
        <div class="stat">
          <div class="stat-figure text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
            </svg>

          </div>
          <div class="stat-title">Total Todolist</div>
          <div class="stat-value text-primary"><?php echo $totalAction ?></div>
          <div class="stat-desc"><?php echo $totalCreated ?> Created</div>
          <div class="stat-desc"><?php echo $totalEdited ?> Edited</div>
          <div class="stat-desc"><?php echo $totalDeleted ?> Deleted</div>
        </div>

        <div class="stat">
          <div class="stat-value"><?php echo $formattedPercentage; ?>%</div>
          <div class="stat-title">Tasks done</div>
          <div class="stat-desc text-secondary"><?php echo $totalNotCompleted; ?> tasks remaining</div>
        </div>

      </div>
    </section>

    <section id="card-todo" class="flex-wrap flex justify-center gap-4 mt-5">
      <span style="display: none;" class="loading loading-spinner text-info"></span>
      <?php if ($result->num_rows == 0) echo ' <div class="flex flex-col justify-center items-center">

<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
</svg>
<div class="text-md mb-2">No data Found</div>
<div>Get started by creating a new todolist.</div>
<button class="mt-3 btn" onclick="my_modal_2.showModal()">
  <p class="text-yellow-300">Tambah data</p>
</button>
</div>'; ?>

      <?php foreach ($todoList as $todo) { ?>

        <div class="card w-96 bg-neutral text-neutral-content">

          <div class="card-body items-center text-center">
            <div class="flex flex-row gap-3 items-center justify-center">
              <h2 class="card-title text-2xl"><?php echo $todo['title']; ?>!</h2>
              <?php if ($todo['isCompleted'] == 1) { ?>
                <button class="badge badge-accent badge-outline">
                  Completed
                </button>
              <?php } ?>
            </div>

            <p><?php echo $todo['activity']; ?></p>
            <div class="card-actions justify-end gap-5">
              <?php if ($todo['isCompleted'] == 1) { ?>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-500">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              <?php } else { ?>
                <button id="btn-completed" onclick="completeTask(<?php echo $todo['id']; ?>)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </button>

              <?php } ?>
              <button data-modal-target="popup-modal" onclick="checkId(<?php echo $todo['id']; ?>)" data-modal-toggle="popup-modal" class="" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-red-500">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </button>

              <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                      </svg>
                      <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                      <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu akan menghapus list ini?</h3>
                      <button onclick="deleteTask()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Ya, Hapus
                      </button>
                      <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak, Batalkan</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal toggle -->
              <?php if ($todo['isCompleted'] == 0) { ?>
                <button onclick="handleFormEdit(`<?php echo $todo['title']; ?>`,`<?php echo $todo['activity']; ?>`,`<?php echo $todo['id']; ?>`)" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-yellow-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                  </svg>
                </button>
              <?php } ?>
              <!-- Main modal -->
              <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Todolist
                      </h3>
                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">

                      <form>
                        <div class="mb-6">
                          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Kegiatan</label>
                          <input type="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan judul kegiatan" name="title" required>
                        </div>
                        <div class="mb-6">
                          <label for="activity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
                          <input type="activity" id="activity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan kegiatan" name="activity" required>
                        </div>
                      </form>

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                      <button onclick="handleEdit()" data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                      <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
      <?php } ?>
    </section>

  </main>

  <footer class="flex justify-center my-5">
    <!-- Add your footer content here -->
    <p>Copyright &copy; Dani Kurniawan. All rights reserved.</p>

  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js" type="text/javascript"></script>




</body>

</html>