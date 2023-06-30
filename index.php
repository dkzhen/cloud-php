<!DOCTYPE html>
<html>

<head>
  <title>Dashboard - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="w-[90%] mx-auto">
  <!-- <dialog id="my_modal_2" class="modal">
    <form method="dialog" class="modal-box">
      <div class="flex flex-col justify-center items-center">
        <h3 class="font-bold text-lg mb-5">
          Apa yang akan kamu lakukan hari ini?
        </h3>
        <form method="POST" action="form_handler.php" onsubmit="handleSubmit(event)">
          <input type="text" placeholder="Judul Agenda" class="input mb-5 input-bordered input-sm input-error w-full max-w-xs" name="judul_agenda" />
          <input type="text" placeholder="Isi kegiatan" class="input input-bordered mb-5 input-sm input-error w-full max-w-xs" name="isi_kegiatan" />
          <button type="submit" class="btn hidden">
            <span class="loading loading-spinner"></span>
            loading
          </button>
          <button type="submit" class="btn text-blue-500">Submit</button>
        </form>
      </div>
    </form>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog> -->
  <dialog id="my_modal_2" class="modal">
    <form id="modal-form" class="modal-box">
      <div class="flex flex-col justify-center items-center">
        <h3 class="font-bold text-lg mb-5">
          Apa yang akan kamu lakukan hari ini?
        </h3>
        <input type="text" placeholder="Judul Agenda" required class="input mb-5 input-bordered input-sm input-error w-full max-w-xs" name="judul_agenda" />
        <input type="text" placeholder="Isi kegiatan" required class="input input-bordered mb-5 input-sm input-error w-full max-w-xs" name="isi_kegiatan" />
        <button type="submit" class="btn text-blue-500">Submit</button>
      </div>
    </form>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
  <nav>
    <!-- Add your navigation menu here -->
    <ul class="flex flex-wrap justify-between px-3 mt-5">
      <li class="hidden md:flex">Hello, Dani Kurniawan</li>
      <div class="flex flex-row justify-center items-center md:gap-8 gap-2">
        <li class="text-lg text-secondary">TodoList</li>
        <!-- Open the modal using ID.showModal() method -->
        <button class="hidden md:flex btn" onclick="my_modal_2.showModal()">
          <p class="text-yellow-300">Tambah data</p>
        </button>
      </div>
      <button class="md:hidden" onclick="my_modal_2.showModal()" class="">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-yellow-400">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
      <li>Sunday , 17 Juni 2023</li>
    </ul>
    <p class="border-b-2 text-transparent border-white">header</p>
  </nav>

  <main cl>
    <section id="insert-data" class=""></section>
    <section id="card-todo" class="flex-wrap flex justify-center gap-4 mt-5">
      <div class="card w-96 bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
          <div class="flex flex-row gap-3 items-center justify-center">
            <h2 class="card-title">Cookies!</h2>
            <button class="badge badge-accent badge-outline">
              Completed
            </button>
          </div>

          <p>We are using cookies for no reason.</p>
          <div class="card-actions justify-end gap-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer class="flex justify-center mt-5">
    <!-- Add your footer content here -->
    <p>&copy;Dani Kurniawan. All rights reserved.</p>

  </footer>
  <script src="script.js" type="text/javascript"></script>

</body>

</html>