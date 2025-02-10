<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Admin</title>
</head>

<x-lend-layout-template>

  <div class="flex gap-3">
    @php              
      $totaluser = $data['totaluser'];
    $totalroleuser = $data['totalroleuser'];
    $totalroleadmin = $data['totalroleadmin'];
    $totalrolepending = $data['totalrolepending'];
    $totalunitkerja = $data['totalunitkerja'];
    $totalitem = $data['totalitem'];
    $totalborrowed = $data['totalborrowed'];
    $totalcategory = $data['totalcategory'];
    $totalservice = $data['totalservice'];
    $totallocation = $data['totallocation'];
    $totaltransaksi = $data['totaltransaksi'];
    $totalpermohonan = $data['totalpermohonan'];
    $totaldiproses = $data['totaldiproses'];
    $totalactiveborrowed = $data['totalactiveborrowed'];
    $totalrejected = $data['totalrejected'];
  @endphp 

    <div id="dashboardumum" class="me-6 ms-1 mt-1 min-h-[54rem] rounded-xl p-10 border w-fit border-gray-900">
      <div class="mt-1 flex-row space-y-10">
        <div id="totaluser">
          <div class=" w-[250px] h-[216px] rounded-xl bg-white border border-gray-300 p-5 flex-row  ">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4B5563" class="h-12 w-12"
                viewBox="0 0 16 16">
                <path
                  d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
              </svg>
            </div>
            <div>
              <h2 class=" text-2xl font-bold text-[#4B5563]">
                <span>{{$totaluser}} Akun</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Pengguna</p>
            </div>

            <a href="/admin/lendasset/users"
              class="flex w-full rounded-xl bg-blue-gray-900/10 p-3 mt-5 justify-between items-center transition-all border border-gray-300 hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

              <span>Selengkapnya</span>

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
              </svg>
            </a>

          </div>
        </div>

        <div id="totalitem">
          <div class="w-[250px] h-[216px] rounded-xl bg-[#F1F5F9] border border-gray-300 p-5 aspect">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363840"
                class="bi bi-box-seam-fill h-14 w-14" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                  d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
              </svg>
            </div>
            <div>
              <h2 class="-mt-2 text-2xl font-bold">
                <span>{{$totalitem}} Jenis/Type</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Item</p>
            </div>

            <a href="/admin/lendasset/items"
              class="flex w-full rounded-xl bg-blue-gray-900/10 p-3 mt-5 justify-between items-center text-gray-600 transition-all border border-gray-600 hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
              <button>
                Selengkapnya
              </button>

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
              </svg>
            </a>
          </div>
        </div>

        <div id="totaltransaksi">
          <div class="w-[250px] h-[216px] rounded-xl bg-gray-600 border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-clipboard2-data-fill h-10 w-10" viewBox="0 0 16 16">
                <path
                  d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5" />
                <path
                  d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585q.084.236.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5q.001-.264.085-.5M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl font-bold text-white">
                <span>{{$totaltransaksi}} </span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-300">Total Transaksi</p>
            </div>

            <a href="/admin/lendasset/report"
              class="flex w-full rounded-xl bg-blue-gray-900/10 p-3 mt-5 justify-between items-center transition-all text-white border border-gray-300 hover:scale-105 focus:scale-105 focus:opacity-[0.85] active:scale-100 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
              <button>
                Selengkapnya
              </button>

              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div id="dashboarddetail"
      class="flex-row space-y-10 me-6 mt-1 min-h-[54rem] rounded-xl p-10 border w-fit border-gray-900">
      <div id="detailuser" class="mt-1 flex space-x-10">
        <div id="totalroleuser">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-white border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4B5563"
                class="bi bi-person-fill-check h-12 w-12" viewBox="0 0 16 16">
                <path
                  d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path
                  d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
              </svg>
            </div>
            <div class="">
              <h2 class="text-2xl font-bold text-[#4B5563]">
                <span>{{$totalroleuser}} akun</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total User</p>
            </div>
          </div>
        </div>

        <div id="totalroleadmin">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-white border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4B5563"
                class="bi bi-person-fill-gear h-12 w-12" viewBox="0 0 16 16">
                <path
                  d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
              </svg>
            </div>
            <div class="">
              <h2 class="text-2xl font-bold text-[#4B5563]">
                <span>{{$totalroleadmin}} akun</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Admin</p>
            </div>
          </div>
        </div>

        <div id="totalrolepending">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-white border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4B5563"
                class="bi bi-person-fill-exclamation h-12 w-12" viewBox="0 0 16 16">
                <path
                  d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                <path
                  d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
              </svg>
            </div>
            <div class="">
              <h2 class="text-2xl font-bold text-[#4B5563]">
                <span>{{$totalrolepending}} akun</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Pending User</p>
            </div>
          </div>
        </div>

        <div id="totalunitkerja">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-white border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#4B5563"
                class="bi bi-buildings-fill h-11 w-11" viewBox="0 0 16 16">
                <path
                  d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-1 text-2xl font-bold text-[#4B5563]">
                <span>{{$totalunitkerja}} UPT</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Unit Kerja</p>
            </div>
          </div>
        </div>
      </div>

      <div id="itemdetail" class="mt-1 flex space-x-10">
        <div id="totalborroweditem">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-[#F1F5F9] border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363840"
                class="bi bi-basket-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl font-bold">
                <span>{{$totalborrowed}} pcs</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Item Dipinjam</p>
            </div>
          </div>
        </div>

        <div id="totalservice">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-[#F1F5F9] border border-gray-300 p-5 aspect">
            <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363840" class="bi bi-router-fill w-10 h-10" viewBox="0 0 16 16">
                                  <path d="M5.525 3.025a3.5 3.5 0 0 1 4.95 0 .5.5 0 1 0 .707-.707 4.5 4.5 0 0 0-6.364 0 .5.5 0 0 0 .707.707"/>
                                  <path d="M6.94 4.44a1.5 1.5 0 0 1 2.12 0 .5.5 0 0 0 .708-.708 2.5 2.5 0 0 0-3.536 0 .5.5 0 0 0 .707.707Z"/>
                                  <path d="M2.974 2.342a.5.5 0 1 0-.948.316L3.806 8H1.5A1.5 1.5 0 0 0 0 9.5v2A1.5 1.5 0 0 0 1.5 13H2a.5.5 0 0 0 .5.5h2A.5.5 0 0 0 5 13h6a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5h.5a1.5 1.5 0 0 0 1.5-1.5v-2A1.5 1.5 0 0 0 14.5 8h-2.306l1.78-5.342a.5.5 0 1 0-.948-.316L11.14 8H4.86zM2.5 11a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m4.5-.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2.5.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m1.5-.5a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0m2 0a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0"/>
                                  <path d="M8.5 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                                </svg> 
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl font-bold">
                <span>{{$totalservice}} Services</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Permohonan Layanan</p>
            </div>
          </div>
        </div>

        <div id="totalcategory">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-[#F1F5F9] border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363840"
                class="bi bi-bookmarks-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5z" />
                <path d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1z" />
              </svg>
            </div>
            <div class="">
              <h2 class=" mt-2 text-2xl font-bold">
                <span>{{$totalcategory}} jenis</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Kategori Item</p>
            </div>
          </div>
        </div>

        

        <div id="totallocation">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-[#F1F5F9] border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363840"
                class="bi bi-map-fill w-10 h-10" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl font-bold">
                <span>{{$totallocation}} tempat</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-500">Total Lokasi Item</p>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-1 flex space-x-10">
        <div id="totalpermohonan">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-gray-600 border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-envelope-plus-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                <path
                  d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl text-white font-bold">
                <span>{{$totalpermohonan}}</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-300">Total Permohonan</p>
            </div>
          </div>
        </div>

        <div id="totaldiproses">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-gray-600 border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-envelope-exclamation-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                <path
                  d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0m0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl text-white font-bold">
                <span>{{$totaldiproses}}</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-300">Total Diproses <br> (Perlu Tindak Lanjut)</p>
            </div>
          </div>
        </div>

        <div id="totalactiveborrowed">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-gray-600 border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-envelope-check-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                <path
                  d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl text-white font-bold">
                <span>{{$totalactiveborrowed}}</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-300">Total Peminjaman Aktif</p>
            </div>
          </div>
        </div>

        <div id="totalrejected">
          <div class=" w-[250px] h-[216px] flex-row rounded-xl bg-gray-600 border border-gray-300 p-5 aspect">
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                class="bi bi-envelope-x-fill w-10 h-10" viewBox="0 0 16 16">
                <path
                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 4.697v4.974A4.5 4.5 0 0 0 12.5 8a4.5 4.5 0 0 0-1.965.45l-.338-.207z" />
                <path
                  d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-4.854-1.354a.5.5 0 0 0 0 .708l.647.646-.647.646a.5.5 0 0 0 .708.708l.646-.647.646.647a.5.5 0 0 0 .708-.708l-.647-.646.647-.646a.5.5 0 0 0-.708-.708l-.646.647-.646-.647a.5.5 0 0 0-.708 0" />
              </svg>
            </div>
            <div class="">
              <h2 class="mt-2 text-2xl text-white font-bold">
                <span>{{$totalrejected}}</span>
              </h2>
            </div>
            <div>
              <p class="font-sans text-base font-medium text-gray-300">Total Permohonan Ditolak</p>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</x-lend-layout-template>