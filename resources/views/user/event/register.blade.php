@extends('layouts/user')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Event</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      {{-- <div class="row">
        @foreach ($informations as $information)
        @php
            $banner = $information->event->banners->first();
            $documents = $information->event->documents;
            $competitions = $information->event->competitions;
        @endphp
        <div class="col-xl-12">
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-2">
                @if ($banner)
                    <img class="img-fluid" src="{{ asset('storage/' . $banner->banner_img) }}" alt="{{ $information->title }}">
                @else
                    <img class="img-fluid" src="{{ asset('img/screen.jpg') }}" alt="Default Banner">
                @endif
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h2 class="mb-3 font-weight-bold">{{ $information->title }}</h2>
                  <p class="card-text text-md">{!! $information->description !!}</p>
                  <div class="mt-8">
                    @foreach ($documents as $document)
                      <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-dark">Unduh {{ $document->document_name }}</a>
                    @endforeach
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        
      </div> --}}

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form Register Athlete</h3>
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
                      <label for="category_id" class="form-label">Competition Type</label>
                      <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                          <option value="" disabled selected>Select a Competition Type</option>
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
                      <label for="age_id" class="form-label">Age Group <span class="text-danger">*</span></label>
                      <select class="form-control @error('age_id') is-invalid @enderror" id="age_id" name="age_id">
                        <option value="" disabled selected>Select a Age Group</option>
                      </select>
                      @error('age_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
    
                    <p id="selectedAgeId" class="d-none"></p>
    
                    <div id="classDropdownContainer" class="form-group d-none">
                      <label for="class_id" class="form-label">Class Group <span class="text-danger">*</span></label>
                      <select class="form-control @error('class_id') is-invalid @enderror" id="class_id" name="class_id">
                        <option value="" disabled selected>Select a Class Group</option>
                      </select>
                      @error('class_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div id="athlete-forms">
                      <div class="form-group athlete-form" id="athlete-form-1" style="display: none;">
                          <label for="athlete_id_1" class="form-label">Athlete 1 <span class="text-danger">*</span></label>
                          <select class="form-control select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_1" name="athlete_id[]" data-placeholder="Select an athlete">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_1') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
                              @endif
                            @endforeach
                          </select>
                          @error('athlete_id') 
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="form-group athlete-form" id="athlete-form-2" style="display: none;">
                          <label for="athlete_id_2" class="form-label">Athlete 2 <span class="text-danger">*</span></label>
                          <select class="form-control  select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_2" name="athlete_id[]" data-placeholder="Select an athlete">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_2') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
                              @endif
                            @endforeach
                          </select>
                          @error('athlete_id') 
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                      </div>
                  
                      <div class="form-group athlete-form" id="athlete-form-3" style="display: none;">
                          <label for="athlete_id_3" class="form-label">Athlete 3 <span class="text-danger">*</span></label>
                          <select class="form-control  select2bs4 @error('athlete_id') is-invalid @enderror" id="athlete_id_3" name="athlete_id[]" data-placeholder="Select an athlete">
                            <option value=""></option>
                            @foreach ($athletes as $athlete)
                              @if (old('athlete_id_3') == $athlete->athlete_id)
                                <option value="{{ $athlete->athlete_id }}" selected>{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
                              @else
                                <option value="{{ $athlete->athlete_id }}">{{ $athlete->athlete_name }} ({{ $athlete->weight }}Kg - {{ $athlete->age->age_name }})</option>
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
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register Athlete</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Athlete List</h3>
    
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
                  <th>Athlete</th>
                  <th>Category</th>
                  <th>Age Group</th>
                  <th>Class</th>
                  <th>Price</th>
                  
                </tr>
                </thead>
                <tbody>
                  @foreach ($registers as $index => $register)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        <ul style="margin: 0; padding: 0;">
                          @foreach ($register->athletes as $athlete)
                              <li>{{ $athlete->athlete_name ?? 'N/A' }}</li>
                          @endforeach
                        </ul>
                      </td>
                      <td>{{ $register->category->category_name ?? 'N/A' }}</td>
                      <td>{{ $register->age->age_name ?? 'N/A' }}</td>
                      @if (isset($register->matchClass))
                        <td>{{ $register->matchClass->class_name }} - {{ $register->matchClass->class_min }}Kg s/d {{ $register->matchClass->class_max }}Kg ({{ $register->matchClass->class_gender }})</td>
                      @else
                        <td>-</td>
                      @endif
                      <td>Rp {{  number_format($register->price, 0, ',', '.') }}</td>
                     
                     
                    </tr>
                    @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
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
        const ageDropdown = document.getElementById('age_id'); // Dropdown untuk age
        
        categoryDropdown.addEventListener('change', function () {
            const selectedValue = this.value;
            selectedCategoryId.innerText = `Selected Category ID: ${selectedValue}`;

            if (selectedValue) {
              // Kirim permintaan ke /ages/{category_id}
              fetch(`/ages/${selectedValue}`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Network response was not ok');
                      }
                      return response.json(); // Ubah respons ke format JSON
                  })
                  .then(data => {
                      // Tampilkan data di konsol
                      console.log('Data fetched:', data);

                      // Kosongkan dropdown age terlebih dahulu
                      ageDropdown.innerHTML = '<option value="" disabled selected>Select a Age Group</option>';

                      // Tambahkan opsi baru berdasarkan data yang diterima
                      data.forEach(age => {
                          const option = document.createElement('option');
                          option.value = age.age_id; // Sesuaikan dengan struktur data
                          option.textContent = age.age_name; // Sesuaikan dengan struktur data
                          ageDropdown.appendChild(option);
                      });
                  })
                  .catch(error => {
                      console.error('Error fetching age groups:', error);
                      // Tampilkan pesan kesalahan jika diperlukan
                  });
          } else {
              // Jika tidak ada kategori yang dipilih, kosongkan dropdown age
              ageDropdown.innerHTML = '<option value="" disabled selected>Select a Age Group</option>';
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
            classDropdown.innerHTML = '<option value="" disabled selected>Select a Class Group</option>'; // Clear options
        }

        // Clear age dropdown when category changes
        ageDropdown.value = '';
        selectedAgeId.innerText = '';
        classDropdown.innerHTML = '<option value="" disabled selected>Select a Class Group</option>'; // Clear class dropdown
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
                    classDropdown.innerHTML = '<option value="" disabled selected>Select a Class Group</option>';

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
            classDropdown.innerHTML = '<option value="" disabled selected>Select a Class Group</option>';
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