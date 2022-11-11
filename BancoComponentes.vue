<template>
  <!-- checkbox start -->
  <!-- colors -->
  <div class="flex items-center mr-4">
    <input checked id="red-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-red-600 bg-gray-100 rounded border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="red-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Red</label>
  </div>
  <div class="flex items-center mr-4">
    <input checked id="green-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-green-600 bg-gray-100 rounded border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="green-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Green</label>
  </div>
  <div class="flex items-center mr-4">
    <input checked id="purple-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-purple-600 bg-gray-100 rounded border-gray-300 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="purple-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Purple</label>
  </div>
  <div class="flex items-center mr-4">
    <input checked id="teal-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="teal-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Teal</label>
  </div>
  <div class="flex items-center mr-4">
    <input checked id="yellow-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-yellow-400 bg-gray-100 rounded border-gray-300 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="yellow-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Yellow</label>
  </div>
  <div class="flex items-center mr-4">
    <input checked id="orange-checkbox" type="checkbox" value=""
      class="w-4 h-4 text-orange-500 bg-gray-100 rounded border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="orange-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Orange</label>
  </div>

  <!-- inline -->
  <div class="flex">
    <div class="flex items-center mr-4">
      <input id="inline-checkbox" type="checkbox" value=""
        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="inline-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline 1</label>
    </div>
    <div class="flex items-center mr-4">
      <input id="inline-2-checkbox" type="checkbox" value=""
        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="inline-2-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline 2</label>
    </div>
    <div class="flex items-center mr-4">
      <input checked id="inline-checked-checkbox" type="checkbox" value=""
        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="inline-checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline
        checked</label>
    </div>
    <div class="flex items-center">
      <input disabled id="inline-disabled-checkbox" type="checkbox" value=""
        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
      <label for="inline-disabled-checkbox" class="ml-2 text-sm font-medium text-gray-400 dark:text-gray-500">Inline
        disabled</label>
    </div>
  </div>
  <!-- checkbox end -->

  <button type="button"
    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
    Primary
  </button>
  <button type="button"
    class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline">
    Success
  </button>
  <button type="button"
    class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline">
    Error
  </button>
  <button type="button"
    class="border border-yellow-500 bg-yellow-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-yellow-600 focus:outline-none focus:shadow-outline">
    Warning
  </button>
  <button type="button"
    class="border border-teal-500 bg-teal-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 focus:outline-none focus:shadow-outline">
    Info
  </button>
  <button type="button"
    class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline">
    Dark
  </button>
  <button type="button"
    class="border border-gray-200 bg-gray-200 text-gray-700 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-300 focus:outline-none focus:shadow-outline">
    Light
  </button>


  Formulário

  <!-- component -->

  <!-- This is an example component -->
  <div class="max-w-2xl mx-auto">

    <form>
      <div class="relative z-0 mb-6 w-full group">
        <input type="email" name="floating_email"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="floating_email"
          class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
          address</label>
      </div>
      <div class="relative z-0 mb-6 w-full group">
        <input type="password" name="floating_password" id="floating_password"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="floating_password"
          class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
      </div>
      <div class="relative z-0 mb-6 w-full group">
        <input type="password" name="repeat_password" id="floating_repeat_password"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="floating_repeat_password"
          class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm
          password</label>
      </div>
      <div class="grid xl:grid-cols-2 xl:gap-6">
        <div class="relative z-0 mb-6 w-full group">
          <input type="text" name="floating_first_name" id="floating_first_name"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label for="floating_first_name"
            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
            name</label>
        </div>
        <div class="relative z-0 mb-6 w-full group">
          <input type="text" name="floating_last_name" id="floating_last_name"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label for="floating_last_name"
            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
            name</label>
        </div>
      </div>
      <div class="grid xl:grid-cols-2 xl:gap-6">
        <div class="relative z-0 mb-6 w-full group">
          <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label for="floating_phone"
            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
            number (123-456-7890)</label>
        </div>
        <div class="relative z-0 mb-6 w-full group">
          <input type="text" name="floating_company" id="floating_company"
            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            placeholder=" " required />
          <label for="floating_company"
            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company
            (Ex. Google)</label>
        </div>
      </div>
      <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

    <p class="mt-5">Check out the original floating label form elements on <a class="text-blue-600 hover:underline"
        href="#" target="_blank">Flowbite</a> and browse other similar components built with Tailwind CSS.
    </p>
  </div>


  <!-- alerts -->


  <div>
    <div class="max-w-xs bg-gray-800 text-sm text-white rounded-md shadow-lg dark:bg-gray-900 mb-3 ml-3 ml-3"
      role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-600 transition-all text-sm dark:focus:ring-offset-gray-900 dark:focus:ring-gray-800">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-gray-500 text-sm text-white rounded-md shadow-lg dark:bg-gray-700 mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-600 focus:ring-gray-500 transition-all text-sm dark:focus:ring-offset-gray-700 dark:focus:ring-gray-500">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-red-500 text-sm text-white rounded-md shadow-lg  mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-800 focus:ring-red-500 transition-all text-sm dark:focus:ring-offset-red-500 dark:focus:ring-red-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-yellow-500 text-sm text-white rounded-md shadow-lg  mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-800 focus:ring-yellow-500 transition-all text-sm dark:focus:ring-offset-yellow-500 dark:focus:ring-yellow-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-green-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-800 focus:ring-green-500 transition-all text-sm dark:focus:ring-offset-green-500 dark:focus:ring-green-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-blue-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-blue-500 transition-all text-sm dark:focus:ring-offset-blue-500 dark:focus:ring-blue-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-indigo-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-800 focus:ring-indigo-500 transition-all text-sm dark:focus:ring-offset-indigo-500 dark:focus:ring-indigo-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-purple-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-purple-800 focus:ring-purple-500 transition-all text-sm dark:focus:ring-offset-purple-500 dark:focus:ring-purple-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-xs bg-pink-500 text-sm text-white rounded-md shadow-lg mb-3 ml-3" role="alert">
      <div class="flex p-4">
        Tailwind Components! Toast Alert!

        <div class="ml-auto">
          <button type="button"
            class="inline-flex flex-shrink-0 justify-center items-center h-4 w-4 rounded-md text-white/[.5] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-pink-800 focus:ring-pink-500 transition-all text-sm dark:focus:ring-offset-pink-500 dark:focus:ring-pink-700">
            <span class="sr-only">Close</span>
            <svg class="w-3.5 h-3.5" width="16" height="16" viewBox="0 0 16 16" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

</template>


<!-- layout novo -->
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CrebsDev App</title>
</head>

<body class="text-gray-700 dark:text-gray-300 dark:bg-gray-700">
    <div class="h-full flex flex-col bg-gray-100 dark:bg-gray-700 shadow-xl overflow-y-scroll mb-0.5 pb-4">
        



        <div class="container mx-auto mt-1 text-justify px-3 rounded-lg bg-teal-50 dark:bg-gray-600 dark:text-gray-400">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent fermentum sed erat a condimentum.
                Suspendisse ante odio, facilisis vel egestas at, ultrices vel ligula. Vestibulum elementum at mauris sed
                condimentum. Etiam finibus dui risus, sit amet eleifend purus elementum et. In neque ligula, semper ut
                feugiat non, molestie non tortor. Maecenas imperdiet nisl magna, ac pharetra erat ultrices a. Mauris
                eleifend, velit auctor volutpat mollis, eros eros sodales elit, eget finibus mauris mi quis nisl.
                Curabitur
                luctus pulvinar eros, mattis semper ex pulvinar lacinia. Nunc quis ex sit amet mauris tristique
                porttitor
                quis eu erat. Mauris aliquam nec orci id vestibulum. Fusce at elit at lacus sodales ultricies. Sed sed
                luctus sem, eu lobortis ligula. Etiam eleifend magna sed purus sodales rutrum. Etiam sit amet libero
                elementum leo tempor tristique vel mattis diam. Donec eget orci sed dui commodo viverra et quis nulla.
            </p>

            <p>Donec in urna nec turpis dictum posuere et in felis. Duis diam dolor, blandit viverra lorem nec, pretium
                cursus magna. Suspendisse nisl lectus, tincidunt a diam non, consequat condimentum turpis. Proin vel
                quam ut
                urna ultricies eleifend at ut orci. Proin maximus urna quam, ultricies mattis neque lobortis quis.
                Maecenas
                ultricies malesuada elementum. Duis condimentum ligula ac tristique fringilla. Aenean non quam blandit,
                lobortis ipsum vitae, gravida odio. Pellentesque rhoncus mauris a ante molestie tincidunt. Nullam
                malesuada
                vulputate tempus. Nullam ut turpis maximus, efficitur erat non, auctor ex.</p>

            <p>Duis nec nunc in risus faucibus eleifend vitae ut orci. Suspendisse aliquet commodo nibh, id tempor nisl.
                Ut
                et luctus ex. Mauris eget mattis odio, commodo congue felis. Ut quis ex iaculis, pretium risus nec,
                volutpat
                ligula. Ut quis dolor id turpis vestibulum commodo. Vivamus id tellus nec erat dapibus efficitur eu quis
                lectus. Nam at posuere metus. Etiam elementum tellus a ante dignissim suscipit. Phasellus pulvinar
                sollicitudin ligula, non efficitur orci feugiat vestibulum. Aenean eleifend facilisis ex a volutpat.
                Nunc
                vulputate lacinia ipsum mollis sollicitudin.</p>
            <p>Fim</p>
        </div>
    </div>

    <footer class="p-4 bg-transparent rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-700">
        <div class="sm:flex sm:items-center sm:justify-between">
            <!--a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a-->
            <ul class="flex flex-wrap items-center mb-6 text-sm sm:mb-0">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
        <span class="block text-sm sm:text-center dark:text-gray-300">© 2022-<?php echo date('Y'); ?> Rodando com <a href="https://crebs.dev"
                class="text-blue-500 hover:text-blue-900 dark:hover:text-white">BaseApp</a>, desenvolvido por <a class="text-blue-500 hover:text-blue-900 dark:hover:text-white" href="https://crebs.dev" target="_blank">CrebsDev</a>. Todos os direitos reservados.
        </span>
    </footer>

</body>

</html>


<nav class="bg-white border-b border-gray-100 dark:bg-gray-600">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center h-16">
                        <div class="flex">
                            <!-- Logo
                            <div class="shrink-0 flex items-center left">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto dark:text-gray-300" />
                                </Link>
                            </div> -->

                            <!-- Navigation Links -->
                            <div class="shrink-0 flex items-center">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                                    :class="route().current('dashboard') ? 'text-green-600 border-green-600 dark:text-green-300 dark:border-green-300' : 'hover:text-gray-200'">
                                    <mdicon name="view-dashboard" title="Dashboard" />
                                </NavLink>
                            </div>

                            <div class="shrink-0 flex items-center">
                                <NavLink :href="route('admin.acl.acl')" :active="route().current('admin.acl.*')"
                                    :class="route().current('admin.acl.*') ? 'text-green-600 border-green-600 dark:text-green-300 dark:border-green-300' : 'hover:text-gray-200'">
                                    <mdicon name="shield-lock-outline" title="Controle de Acesso" />
                                </NavLink>
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="shrink-0 flex items-center">
                                <Dropdown width="w-32">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 dark:bg-transparent">
                                                <mdicon name="account-arrow-right" />
                                            </button>
                                        </span>
                                    </template>
                                    <template #content>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Sair
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>