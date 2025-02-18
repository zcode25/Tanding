@extends('layouts/user')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Perlombaan - {{ $information->title }}</h1>
          </div>
          {{-- <div class="col-sm-6">
            <div class="float-sm-right">

            </div>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      @if (!isset($payment->status))
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pendaftaran Atlet</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/userEvent/register/store/" method="POST" class="form-horizontal">
              @csrf
              <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="form-group">
                      <label for="category_id" class="form-label">Kategori Pertandingan <span class="text-danger">*</span></label>
                      <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                          <option value="" disabled selected>Pilih Kategori Pertandingan</option>
                          @foreach ($groupedCompetitions as $groupedCompetition)
                            <option 
                              value="{{ $groupedCompetition->first()->category->category_id }}" 
                              data-category-type="{{ $groupedCompetition->first()->category->category_type }}">
                              {{ $groupedCompetition->first()->category->category_name }}
                            </option>
                          @endforeach
                      </select>
                      @error('category_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <p id="selectedCategoryId" class="d-none"></p>

                    <div class="form-group">
                      <label for="age_id" class="form-label">Kategori Umur <span class="text-danger">*</span></label>
                      <select class="form-control @error('age_id') is-invalid @enderror" id="age_id" name="age_id">
                        <option value="" disabled selected>Pilih Kategori Umur</option>
                      </select>
                      @error('age_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
    
                    <p id="selectedAgeId" class="d-none"></p>
                    <input type="hidden" name="gender" id="selectedGender">
    
                    <div id="classDropdownContainer" class="form-group d-none">
                      <label for="class_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                      <select class="form-control @error('class_id') is-invalid @enderror" id="class_id" name="class_id">
                        <option value="" disabled selected>Pilih Kelas</option>
                      </select>
                      @error('class_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div id="athlete-forms">
                      <div class="form-group athlete-form" id="athlete-form-1" style="display: none;">
                          <label for="athlete_id_1" class="form-label">Atlet 1 <span class="text-danger">*</span></label>
                          <select class="form-control select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_1" name="athlete_id[]" data-placeholder="Pilih Atlet">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_1') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @endif
                            @endforeach
                          </select>
                          @error('athlete_id') 
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="form-group athlete-form" id="athlete-form-2" style="display: none;">
                          <label for="athlete_id_2" class="form-label">Atlet 2 <span class="text-danger">*</span></label>
                          <select class="form-control  select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_2" name="athlete_id[]" data-placeholder="Pilih Atlet">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_2') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @endif
                            @endforeach
                          </select>
                          @error('athlete_id') 
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="form-group athlete-form" id="athlete-form-3" style="display: none;">
                          <label for="athlete_id_3" class="form-label">Atlet 3 <span class="text-danger">*</span></label>
                          <select class="form-control  select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_3" name="athlete_id[]" data-placeholder="Pilih Atlet">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_3') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</option>
                              @endif
                            @endforeach
                          </select>
                          @error('athlete_id') 
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                  </div>
                </div>

                {{-- <div class="d-grid gap-2">
                  <button type="submit" name="submit" class="btn btn-primary ">Register Athlete</button>
                </div> --}}
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary float-right">Daftar Atlet</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Atlet</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            
            <div class="card-body">
              
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Atlet</th>
                  <th>Kategori Pertandingan</th>
                  <th>Kategori Umur</th>
                  <th>Jenis Kelamin</th>
                  <th>Kelas</th>
                  <th>Harga</th>
                  @if (!isset($payment->status))
                  <th>Aksi</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                  @foreach ($registers as $index => $register)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        <ul style="margin: 0; padding: 0; list-style-type: none;">
                          @foreach ($register->athletes as $athlete)
                              <li style="position: relative; padding-left: 15px;">
                                  <span style="position: absolute; left: 0;">-</span> {{ $athlete->athlete_name }}
                              </li>
                          @endforeach
                        </ul>
                      </td>
                      <td>{{ $register->category->category_name ?? 'N/A' }}</td>
                      <td>{{ $register->age->age_name ?? 'N/A' }}</td>
                      <td>{{ $register->gender ?? 'N/A' }}</td>
                      @if (isset($register->matchClass))
                        <td>{{ $register->matchClass->class_name }} ({{ $register->matchClass->class_min }}Kg s/d {{ $register->matchClass->class_max }}Kg)</td>
                      @else
                        <td>-</td>
                      @endif
                      <td>Rp {{  number_format($register->price, 0, ',', '.') }}</td>
                      @if (!isset($payment->status))
                      <td class="py-0 align-middle">
                        <a href="/userEvent/register/destroy/{{ $register->register_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                      @endif
                     
                    </tr>
                    @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-2">
                <img class="img-fluid" src="{{ asset('img/screen.jpg') }}" alt="Default Banner">
              </div>
              <div class="col-md-10 d-flex align-items-center">
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-4">
                      <p class="card-text mb-1">Total Biaya Pendaftaran</p>
                      <p class="font-weight-bold h3 mb-1">Rp {{  number_format($totalPrice, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-xl-4">
                      <p class="card-text mb-1">Total Pendaftaran</p>
                      <p class="font-weight-bold h3 mb-1">{{  count($registers) }}</p>
                    </div>
                    <div class="col-xl-4">
                      <p class="card-text mb-1">Nama Official & Kontingen</p>
                      <p class="font-weight-bold h5 mb-1">{{ $contingent->user->name }} ({{ $contingent->contingent_name }})</p>
                    </div>
                  </div>
                  @if (isset($payment->status))
                    <a href="/userEvent/register/payment/{{ $event->event_id }}" class="btn btn-success mt-3">Lihat Invoice</a>
                  @else
                    <a href="/userEvent/register/payment/{{ $event->event_id }}" class="btn btn-success mt-3">Bayar Biaya Pendaftaran</a>
                  @endif
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const categoryDropdown = document.getElementById('category_id');
    const selectedCategoryId = document.getElementById('selectedCategoryId');
    const ageDropdown = document.getElementById('age_id');
    const selectedGender = document.getElementById('selectedGender'); // Tambahkan elemen untuk gender

    categoryDropdown.addEventListener('change', function () {
        const selectedValue = this.value;
        selectedCategoryId.innerText = `Selected Category ID: ${selectedValue}`;

        if (selectedValue) {
            fetch(`/ages/${selectedValue}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data fetched:', data);

                    ageDropdown.innerHTML = '<option value="" disabled selected>Pilih Kategori Umur</option>';

                    data.forEach(age => {
                        const option = document.createElement('option');
                        option.value = age.age_id;
                        option.textContent = age.age_name;
                        option.dataset.gender = age.gender; // Simpan gender sebagai dataset

                        ageDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching age groups:', error);
                });
        } else {
            ageDropdown.innerHTML = '<option value="" disabled selected>Pilih Kategori Umur</option>';
        }
    });

    // Tambahkan event listener untuk menangkap gender saat umur dipilih
    ageDropdown.addEventListener('change', function () {
        const selectedOption = ageDropdown.options[ageDropdown.selectedIndex];
        if (selectedOption) {
            selectedGender.value = selectedOption.dataset.gender; // Simpan gender dalam input tersembunyi
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryDropdown = document.getElementById('category_id');
    const ageDropdown = document.getElementById('age_id');
    const selectedAgeId = document.getElementById('selectedAgeId');
    const classDropdownContainer = document.getElementById('classDropdownContainer');
    const classDropdown = document.getElementById('class_id');

    if (!categoryDropdown || !ageDropdown || !selectedAgeId || !classDropdown || !classDropdownContainer) {
        console.error('One or more dropdown elements are missing in the DOM.');
        return;
    }

    categoryDropdown.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const categoryType = selectedOption.getAttribute('data-category-type');
        const selectedCategoryId = this.value;

        // Show or hide class dropdown based on category type
        if (categoryType === 'Tanding') {
            classDropdownContainer.classList.remove('d-none'); // Show dropdown
        } else {
            classDropdownContainer.classList.add('d-none'); // Hide dropdown
            classDropdown.innerHTML = '<option value="" disabled selected>Pilih Kelas</option>'; // Clear options
        }

        // Clear age dropdown when category changes
        ageDropdown.value = '';
        selectedAgeId.innerText = '';
        classDropdown.innerHTML = '<option value="" disabled selected>Pilih Kelas</option>'; // Clear class dropdown
    });

    ageDropdown.addEventListener('change', function () {
        const selectedValue = this.value;
        selectedAgeId.innerText = `Selected Age ID: ${selectedValue}`;

        if (selectedValue) {
            // Fetch data from the API
            fetch(`/classes/${selectedValue}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Failed to fetch data: ${response.status} ${response.statusText}`);
                    }
                    return response.json(); // Parse JSON response
                })
                .then(data => {
                    // Clear the class dropdown before adding new options
                    classDropdown.innerHTML = '<option value="" disabled selected>Pilih Kelas</option>';

                    data.forEach(classItem => {
                        const option = document.createElement('option');
                        option.value = classItem.class_id; // Adjust according to API response
                        option.textContent = classItem.class_name; // Adjust according to API response
                        classDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching class groups:', error);
                });
        } else {
            // Clear the class dropdown if no age is selected
            classDropdown.innerHTML = '<option value="" disabled selected>Pilih Kelas</option>';
        }
    });
});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const categoryDropdown = document.getElementById('category_id');
      const athleteForms = document.querySelectorAll('.athlete-form');

      if (!categoryDropdown || athleteForms.length === 0) {
          console.error('Required elements are missing.');
          return;
      }

      categoryDropdown.addEventListener('change', function () {
          const selectedCategoryId = this.value;

          if (selectedCategoryId) {
              // Fetch category amount dynamically based on selected category ID
              fetch(`/get-category-amount/${selectedCategoryId}`)
                  .then(response => response.json())
                  .then(data => {
                      const categoryAmount = data.category_amount; // e.g., 'single', 'double', 'group'

                      // Reset all athlete forms
                      athleteForms.forEach(form => form.style.display = 'none');

                      // Display athlete forms based on category amount
                      if (categoryAmount === 'Single') {
                          document.getElementById('athlete-form-1').style.display = 'block';
                      } else if (categoryAmount === 'Double') {
                          document.getElementById('athlete-form-1').style.display = 'block';
                          document.getElementById('athlete-form-2').style.display = 'block';
                      } else if (categoryAmount === 'Group') {
                          document.getElementById('athlete-form-1').style.display = 'block';
                          document.getElementById('athlete-form-2').style.display = 'block';
                          document.getElementById('athlete-form-3').style.display = 'block';
                      } else {
                          console.warn('Invalid category amount:', categoryAmount);
                      }
                  })
                  .catch(error => {
                      console.error('Error fetching category amount:', error);
                  });
          } else {
              // Hide all forms if no category is selected
              athleteForms.forEach(form => form.style.display = 'none');
          }
      });
  });
</script>

  

@endsection